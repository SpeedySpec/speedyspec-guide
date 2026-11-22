import { beforeAll, describe, expect, test } from 'bun:test';
import { existsSync } from 'node:fs';
import { join } from 'node:path';
import { fixtureSite } from './fixture-build.ts';
import { html } from './helpers.ts';

let dist = '';
beforeAll(() => {
  dist = fixtureSite();
}, 240_000);

describe('the WordPress API section', () => {
  test('the index lists each seam with its documented count', async () => {
    const p = await html(dist, '/wordpress/');
    expect(p.text('.seam-list a')).toEqual(['Hooks', 'Options']);
    expect(p.text('.seam-list .count')).toEqual(['2 of 5 documented', '0 of 2 documented']);
  });

  test('a seam page has its introduction, diagram and members by role', async () => {
    const p = await html(dist, '/wordpress/hooks/');
    expect(p.text('h1')).toEqual(['Hooks']);
    expect(p.raw).toContain('Hooks are how WordPress code lets other code change what it does.');
    expect(p.count('figure.diagram picture')).toBe(1);
    expect(p.text('.members h2')).toEqual(['Register', 'Run', 'Classes and state', 'Other']);
    expect(p.text('.members .member a')).toEqual(['add_filter', 'apply_filters', 'WP_Hook', 'wp_filter', 'the_content']);
  });

  test('a_seam_page_links_the_apis_documented_elsewhere', async () => {
    const p = await html(dist, '/wordpress/options/');
    expect(p.text('.elsewhere a')).toEqual(['The Sodium extension']);
    expect(p.raw).toContain('href="https://www.php.net/manual/en/book.sodium.php"');
    expect(p.raw).toContain('sodium_compat is a pure-PHP polyfill of the extension.');
    expect((await html(dist, '/wordpress/hooks/')).count('.elsewhere')).toBe(0);
  });

  test('a function page has every part, in order', async () => {
    const p = await html(dist, '/wordpress/hooks/add_filter/');
    expect(p.text('h1')).toEqual(['add_filter()']);
    expect(p.text('.content h2')).toEqual(['Examples', 'Behaviour', 'Fires', 'History']);
    expect(p.count('.panel')).toBe(1);
    expect(p.text('.signature')).toEqual(['add_filter($hook_name, $callback, $priority = 10, $accepted_args = 1)']);
    expect(p.text('.ev')).toEqual(['scenario hooks/add_filter_returns_true']);
    expect(p.text('.change')).toEqual(['Changed in WordPress 2.0.0: The priority argument became optional.']);
    expect(p.attr('.on-speedyspec a', 'href')).toEqual(['/speedyspec/hooks/add_filter/']);
    const order = ['class="head"', 'class="panel"', 'class="signature"', 'class="examples"', 'Always returns', 'class="fires"', 'class="history"', 'class="on-speedyspec"'].map((s) => p.raw.indexOf(s));
    expect(order.every((at, i) => at > 0 && (i === 0 || at > order[i - 1]!))).toBe(true);
  });

  test('a class page has a section per method, with its anchor', async () => {
    const p = await html(dist, '/wordpress/hooks/class/WP_Hook/');
    expect(p.text('.rail-methods .rail-member')).toEqual(['::add_filter', '::apply_filters']);
    expect(p.attr('.method h2', 'id')).toEqual(['add_filter', 'apply_filters']);
    expect(p.text('.not-documented')).toEqual(['Not yet documented. Signature and relationships are generated from WordPress 7.2-RC1.']);
  });

  test('a hook page names who fires it', async () => {
    const p = await html(dist, '/wordpress/options/filter/pre_option_{option}/');
    expect(p.text('.rail-member')).toContain('filter pre_option_{$option}');
    expect(p.text('h1')).toEqual(['pre_option_{$option}']);
    expect(p.text('.fired-by a')).toEqual(['get_option']);
  });

  test('a global has its own page', async () => {
    expect((await html(dist, '/wordpress/hooks/global/wp_filter/')).text('h1')).toEqual(['$wp_filter']);
  });

  test('no page for an unassigned symbol, and none for a method', () => {
    expect(existsSync(join(dist, 'wordpress', 'unassigned'))).toBe(false);
    expect(existsSync(join(dist, 'wordpress', 'hooks', 'class', 'WP_Hook#apply_filters'))).toBe(false);
  });
});
