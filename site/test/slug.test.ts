import { describe, expect, test } from 'bun:test';
import { assertUniqueSlugs, methodAnchor, symbolFromSlug, symbolSlug } from '../src/model/slug.ts';

const cases: [string, string][] = [
  ['function:add_filter', 'add_filter'],
  ['class:WP_Hook', 'WP_Hook'],
  ['class:WpOrg\\Requests\\Exception', 'WpOrg.Requests.Exception'],
  ['filter:the_content', 'filter/the_content'],
  ['action:init', 'action/init'],
  ['filter:pre_option_{$option}', 'filter/pre_option_{option}'],
  ["filter:{$meta_type}_{$args['type']}", 'filter/{meta_type}_{args-type}'],
  ['global:wp_filter', 'global/wp_filter'],
  ['constant:ABSPATH', 'constant/ABSPATH'],
  ['filter:a b/c', 'filter/a-b-c'],
];

describe('symbolSlug', () => {
  for (const [id, slug] of cases) {
    test(`${id} → ${slug}`, () => expect(symbolSlug(id)).toBe(slug));
  }

  test('a method is an anchor on its class page', () => {
    expect(symbolSlug('method:WP_Hook::apply_filters')).toBe('WP_Hook#apply_filters');
    expect(methodAnchor('method:WP_Hook::apply_filters')).toEqual({ page: 'WP_Hook', anchor: 'apply_filters' });
  });

  test('symbolFromSlug inverts every case', () => {
    const ids = new Set(cases.map(([id]) => id));
    for (const [id, slug] of cases) expect(symbolFromSlug(slug, ids)).toBe(id);
    expect(symbolFromSlug('nope', ids)).toBeUndefined();
  });

  test('two ids with one slug are refused, naming both', () => {
    expect(() => assertUniqueSlugs(['filter:x{$a}', 'filter:x{a}'])).toThrow(/filter:x\{\$a\}.*filter:x\{a\}|filter:x\{a\}.*filter:x\{\$a\}/);
    expect(() => assertUniqueSlugs(['filter:a.b', 'filter:a-b'])).not.toThrow();
  });
});
