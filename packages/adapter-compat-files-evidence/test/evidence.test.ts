import { describe, expect, test } from 'bun:test';
import { join } from 'node:path';
import { CompatFilesEvidence } from '../src/index.ts';

const f = join(import.meta.dir, '..', '..', '..', 'tests', 'fixtures');
const ev = new CompatFilesEvidence(join(f, 'server'), join(f, 'wordpress'));

describe('CompatFilesEvidence', () => {
  test('scenarios', async () => {
    expect(await ev.scenarioExists('hooks', 'add_filter_returns_true')).toBe(true);
    expect(await ev.scenarioExists('hooks', 'nope')).toBe(false);
    expect(await ev.scenarioExists('options', 'add_filter_returns_true')).toBe(false);
  });
  test('breaks, with and without a step', async () => {
    expect(await ev.breakExists('hooks', 'wp_filters_read_and_write', 5)).toBe(true);
    expect(await ev.breakExists('hooks', 'wp_filters_read_and_write', 4)).toBe(false);
    expect(await ev.breakExists('hooks', 'wp_filter_replace_wholesale')).toBe(true);
    expect(await ev.breakExists('hooks', 'wp_filter_replace_wholesale', 2)).toBe(true);
    // Without a step, a citation names the scenario's breaks, whichever steps they are at.
    expect(await ev.breakExists('hooks', 'wp_filters_read_and_write')).toBe(true);
    expect(await ev.breakExists('hooks', 'nope')).toBe(false);
  });
  test('tests, as crate::file::function', async () => {
    expect(await ev.testExists('speedyspec-wp-hooks-php::wordpress::replays_the_hooks_fixture')).toBe(true);
    expect(await ev.testExists('speedyspec-wp-hooks-php::wordpress::missing')).toBe(false);
    expect(await ev.testExists('bad-path')).toBe(false);
    // Harness-style tests name their checks in strings: check("name", …).
    expect(await ev.testExists('speedyspec-wp-hooks-php::wordpress::php_hook_store_binding_takes_every_registration')).toBe(true);
    expect(await ev.testExists('speedyspec-wp-hooks-php::wordpress::not_a_check')).toBe(false);
    // Only a check's name counts, not any string in the file.
    expect(await ev.testExists('speedyspec-wp-hooks-php::wordpress::kept')).toBe(false);
  });
  test('source lines', async () => {
    expect(await ev.sourceLines('wp', 'wp-includes/plugin.php', 2, 3)).toBe('function add_filter( $hook_name, $callback ) {\n\treturn true;');
    expect(await ev.sourceLines('wp', 'wp-includes/plugin.php', 9, 10)).toBeNull();
    expect(await ev.sourceLines('ss', 'nope.php', 1, 1)).toBeNull();
    expect(await ev.sourceLines('wp', '../outside.php', 1, 1)).toBeNull();
    // ss: cites speedyspec-server only: crates/ and compat/. Anything else (the old packages/ fork) is no citation.
    expect(await ev.sourceLines('ss', 'wp-option/wp-option-legacy/functions/option.php', 1, 1)).toBeNull();
    expect(await ev.sourceLines('ss', 'crates/speedyspec-wp-hooks-php/src/hooks.php', 3, 3)).toBe("    $GLOBALS['wp_current_filter'] = array();");
    expect(await ev.sourceLines('ss', 'compat/hooks/breaks.json', 1, 1)).toBe('{ "breaks": [');
  });
});

describe('catalogue', () => {
  test("an area's scenarios and breaks, or null", async () => {
    const c = await ev.catalogue('hooks');
    expect(c?.scenarios.map((s) => s.name)).toEqual(['add_filter_returns_true', 'wp_filters_read_and_write']);
    expect(c?.breaks.map((b) => b.scenario)).toEqual(['wp_filter_replace_wholesale', 'wp_filters_read_and_write']);
    expect(await ev.catalogue('nope')).toBeNull();
  });
});

describe('the recorders that fired', () => {
  test('each_scenarios_fired_recorders_come_from_every_recorded_release_file', async () => {
    const c = await ev.catalogue('options');
    expect(c?.fired).toEqual({ get_with_pre_option: ['rec:pre_option_blogname'], network_only: ['rec:pre_site_option_x'] });
  });
  test('an_area_without_recorded_results_has_none', async () => {
    expect((await ev.catalogue('hooks'))?.fired).toBeUndefined();
  });
});

describe('compatVersion', () => {
  test("the WordPress release an area's scenarios were recorded against, or null", async () => {
    // hooks' source.json is {}, so the repository's pin (compat/wordpress.json) answers; options overrides it.
    expect(await ev.compatVersion('hooks')).toBe('7.2-RC2');
    expect(await ev.compatVersion('options')).toBe('7.1.5');
    expect(await ev.compatVersion('nope')).toBeNull();
  });
});

describe('a crate that moved to speedyspec-platform', () => {
  // The server first, then the platform: a citation stays valid when its crate or compat area moves.
  const both = new CompatFilesEvidence([join(f, 'server'), join(f, 'platform')], join(f, 'wordpress'));
  test('tests, source lines and compat areas are found in the platform', async () => {
    expect(await both.testExists('speedyspec-shared::moved::moved_with_its_crate')).toBe(true);
    expect(await both.sourceLines('ss', 'crates/speedyspec-shared/src/lib.rs', 2, 2)).toBe('pub fn shared() {}');
    expect(await both.scenarioExists('shared', 'shared_scenario')).toBe(true);
    // compat/wordpress.json is the server's: the platform area has no override.
    expect(await both.compatVersion('shared')).toBe('7.2-RC2');
  });
  test('the server still answers first', async () => {
    expect(await both.testExists('speedyspec-wp-hooks-php::wordpress::replays_the_hooks_fixture')).toBe(true);
    expect(await both.compatVersion('options')).toBe('7.1.5');
    expect(await ev.testExists('speedyspec-shared::moved::moved_with_its_crate')).toBe(false);
  });
  test('the crates and compat areas only the platform has are listed, for links', async () => {
    expect(await both.platformPaths()).toEqual({ crates: ['speedyspec-shared'], compat: ['shared'] });
    expect(await ev.platformPaths()).toEqual({ crates: [], compat: [] });
  });
});
