import { describe, expect, test } from 'bun:test';
import { assertUniqueSlugs, methodAnchor, symbolFromSlug, symbolSlug, uniqueSlugs } from '../src/model/slug.ts';

const cases: [string, string][] = [
  ['function:add_filter', 'add_filter'],
  ['class:WP_Hook', 'class/WP_Hook'],
  ['class:WpOrg\\Requests\\Exception', 'class/WpOrg.Requests.Exception'],
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
    expect(symbolSlug('method:WP_Hook::apply_filters')).toBe('class/WP_Hook#apply_filters');
    expect(methodAnchor('method:WP_Hook::apply_filters')).toEqual({ page: 'class/WP_Hook', anchor: 'apply_filters' });
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

describe('slugs that differ only in case', () => {
  test('a class and a function with the same name no longer share a page', () => {
    expect(symbolSlug('class:WP_Scripts')).not.toBe(symbolSlug('function:wp_scripts'));
  });

  test('ids that would share a path on a case-insensitive file system get a numbered slug, the same every time', () => {
    const slugs = uniqueSlugs(['global:post_id', 'global:post_ID', 'function:add_filter']);
    expect(slugs.get('global:post_ID')).toBe('global/post_ID');
    expect(slugs.get('global:post_id')).toBe('global/post_id~2');
    expect(slugs.get('function:add_filter')).toBe('add_filter');
  });

  test('assertUniqueSlugs refuses slugs that differ only in case', () => {
    expect(() => assertUniqueSlugs(['constant:OBJECT', 'constant:object'])).toThrow(/constant:OBJECT.*constant:object/);
  });
});
