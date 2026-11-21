import { existsSync } from 'node:fs';
import { join } from 'node:path';
import { beforeAll, describe, expect, test } from 'bun:test';
import { fixtureSite } from './fixture-build.ts';
import { html } from './helpers.ts';

let dist = '';
beforeAll(() => {
  dist = fixtureSite();
}, 240_000);

describe('the SpeedySpec API section', () => {
  test('the index lists each seam as ported or not, with its cross-seam dependencies', async () => {
    const p = await html(dist, '/speedyspec/');
    expect(p.text('.seam-list a')).toEqual(['Hooks', 'Options']);
    expect(p.text('.seam-list .state')).toEqual(['Native (Rust)', "WordPress's PHP"]);
    expect(p.text('.seam-list .deps')).toEqual(['1 cross-seam dependency', '1 cross-seam dependency']);
  });

  test("a seam page has the compatibility table, dependencies with their state, and its cycles", async () => {
    const p = await html(dist, '/speedyspec/hooks/');
    expect(p.text('.compat tbody tr td:first-child')).toContain('add_filter circular');
    expect(p.text('.compat .pill')[0]).toBe('Works with differences');
    expect(p.text('.depends-on h3')).toEqual(['Options']);
    expect(p.text('.depends-on .dep-state')).toEqual(['not yet recorded']);
    expect(p.text('.depended-on-by .dep-state')).toEqual(["calls WordPress's PHP"]);
    expect(p.text('.cycles .path')).toEqual(['add_filter → get_option → add_filter circular']);
    expect(p.count('.cycles .ev')).toBe(2);
    expect(p.attr('.seam-links a', 'href')).toEqual(['/speedyspec/porting/hooks/', '/speedyspec/architecture/hooks/']);
  });

  test("a seam's full dependency and cycle lists have pages of their own, linked from the seam page", async () => {
    const seam = await html(dist, '/speedyspec/hooks/');
    expect(seam.attr('.all-link', 'href')).toEqual(['/speedyspec/hooks/depends-on/', '/speedyspec/hooks/depended-on-by/', '/speedyspec/hooks/cycles/']);
    const out = await html(dist, '/speedyspec/hooks/depends-on/');
    expect(out.attr('.other-seams a', 'href')).toEqual(['/speedyspec/hooks/depends-on/options/']);
    const outOptions = await html(dist, '/speedyspec/hooks/depends-on/options/');
    expect(outOptions.text('.depends-on h3')).toEqual(['Options']);
    const into = await html(dist, '/speedyspec/hooks/depended-on-by/options/');
    expect(into.text('.depended-on-by .dep-state')).toEqual(["calls WordPress's PHP"]);
    const cycles = await html(dist, '/speedyspec/hooks/cycles/');
    expect(cycles.text('.cycles .path')).toEqual(['add_filter → get_option → add_filter circular']);
  });

  test('a symbol page shows the verdict, its differences with their break, and links back to WordPress', async () => {
    const p = await html(dist, '/speedyspec/hooks/add_filter/');
    expect(p.text('.verdict .pill')).toEqual(['Works with differences']);
    expect(p.text('.differences li')).toEqual(['Replacing $wp_filter wholesale is not seen. break hooks/wp_filter_replace_wholesale']);
    expect(p.text('.provenance .muted')).toEqual(['Added in SpeedySpec unreleased · Native (Rust)']);
    expect(p.raw).toContain('Swap the hook store adapter.');
    expect(p.attr('.wordpress-link a', 'href')).toEqual(['/wordpress/hooks/add_filter/']);
  });

  test('a SpeedySpec class page has a section per method, and its page content from a nested file', async () => {
    const p = await html(dist, '/speedyspec/hooks/class/WP_Hook/');
    expect(p.attr('.method h2', 'id')).toEqual(['add_filter', 'apply_filters']);
    expect(p.text('.method .signature')).toEqual(['public add_filter($hook_name, $callback, $priority, $accepted_args)', 'public apply_filters($value, $args)']);
    expect(p.raw).toContain('The same class, backed by the native store.');
  });

  test('an unported seam lists its symbols as not in SpeedySpec yet, and they get no SpeedySpec page', async () => {
    const p = await html(dist, '/speedyspec/options/');
    // Every row would say the same, so the verdict shows once and the symbols are listed.
    expect(p.text('.compat-uniform .pill')).toContain('Not in SpeedySpec yet');
    expect(p.text('.compat-list a')).toContain('get_option');
    expect(p.count('.compat tbody tr')).toBe(0);
    expect(existsSync(join(dist, 'speedyspec', 'options', 'get_option', 'index.html'))).toBe(false);
  });

  test('the runtime page lists runtime symbols no seam lists', async () => {
    const p = await html(dist, '/speedyspec/runtime/');
    expect(p.text('.runtime-symbol .mono')).toEqual(['SpeedySpec\\Hooks\\Hook']);
  });

  test('the architecture page draws the crates even before its text is written', async () => {
    const p = await html(dist, '/speedyspec/architecture/hooks/');
    expect(p.text('.not-written')).toEqual(['Not written yet.']);
    expect(p.count('figure.diagram picture')).toBe(1);
  });
});
