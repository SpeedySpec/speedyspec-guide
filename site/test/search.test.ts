import { beforeAll, describe, expect, test } from 'bun:test';
import { existsSync } from 'node:fs';
import { join } from 'node:path';
import { fixtureSite } from './fixture-build.ts';
import { html } from './helpers.ts';

let dist = '';
beforeAll(() => {
  dist = fixtureSite();
}, 240_000);

describe('search and coverage', () => {
  test('Pagefind indexes the site', () => {
    expect(existsSync(join(dist, 'pagefind', 'pagefind.js'))).toBe(true);
  });

  test("a reference page's body is indexed, its name weighted", async () => {
    const p = await html(dist, '/wordpress/hooks/add_filter/');
    expect(p.count('[data-pagefind-body]')).toBe(1);
    expect(p.attr('h1', 'data-pagefind-weight')).toEqual(['10']);
  });

  test('every page has the search box', async () => {
    expect((await html(dist, '/')).count('#search')).toBe(1);
  });

  test('the coverage page shows each seam and the unassigned symbols by folder', async () => {
    const p = await html(dist, '/coverage/');
    expect(p.text('.coverage tbody tr:first-child td')).toEqual(['Hooks', 'ported', '5', '2', '1', '4']);
    expect(p.text('.unassigned-count')).toEqual(['1 symbol is in no seam yet.']);
    expect(p.text('.unassigned h3')).toEqual(['wp-includes']);
    expect(p.text('.unassigned li')).toEqual(['unassigned_thing']);
  });

  test('the home page explains the two sections and how to read a verdict', async () => {
    const p = await html(dist, '/');
    expect(p.text('.legend .pill')).toEqual(['Works as WordPress', 'Works with differences', 'Breaks', 'New in SpeedySpec', 'Same code as WordPress', 'Modified in SpeedySpec', 'Removed in SpeedySpec', 'Not yet compared']);
    expect(p.attr('.porting-links a', 'href')).toEqual(['/speedyspec/porting/hooks/', '/speedyspec/porting/options/']);
  });
});
