import { beforeAll, describe, expect, test } from 'bun:test';
import { join } from 'node:path';
import { type GuideData, readGuideData } from '../src/model/data.ts';
import { speedyspecProvenance, speedyspecVerdict, wordpressProvenance } from '../src/model/verdict.ts';
import { exampleFolder, seamView, symbolView } from '../src/model/views.ts';

const fixtures = join(import.meta.dir, 'fixtures');
let d: GuideData;
beforeAll(async () => {
  d = await readGuideData({ GUIDE_DATA_DIR: join(fixtures, 'generated'), GUIDE_SEAMS_DIR: join(fixtures, 'seams'), GUIDE_CONTENT_DIR: join(fixtures, 'content') });
});

describe('verdicts', () => {
  test("a SpeedySpec page's verdict wins", () => {
    expect(speedyspecVerdict('function:add_filter', d)).toEqual({ verdict: 'works-with-differences', differences: [{ summary: 'Replacing $wp_filter wholesale is not seen.', break: 'wp_filter_replace_wholesale' }], source: 'page' });
  });
  test('an unported symbol is not in SpeedySpec yet', () => {
    expect(speedyspecVerdict('function:get_option', d)).toMatchObject({ verdict: 'not-in-speedyspec', source: 'seam' });
  });
  test('a ported symbol without a page is not yet compared', () => {
    expect(speedyspecVerdict('function:apply_filters', d)).toEqual({ verdict: 'unknown', differences: [], source: 'none' });
  });
});

describe('provenance', () => {
  test('a WordPress page citing a scenario is verified, with since from history', () => {
    expect(wordpressProvenance('function:add_filter', d)).toEqual({ tier: 'verified', wordpress: '7.2-RC1', commit: 'ce78d2d6eb8b7dc98a5e896760f5642049288868', compat: '7.1.5', released: true, since: '0.71' });
  });
  test('a page citing only source is read from source', () => {
    expect(wordpressProvenance('function:apply_filters', d).tier).toBe('read-from-source');
  });
  test('no page is not documented', () => {
    expect(wordpressProvenance('class:WP_Hook', d)).toMatchObject({ tier: 'not-documented', since: '2.0.0' });
  });
  test('SpeedySpec provenance: unreleased and native', () => {
    expect(speedyspecProvenance('function:add_filter', d)).toEqual({ added: 'unreleased', native: true });
    expect(speedyspecProvenance('function:get_option', d)).toEqual({ added: 'unreleased', native: false });
  });
});

describe('seamView', () => {
  test('members by role in seam.yaml order, the rest in other, methods under their class', () => {
    const v = seamView('hooks', 'wordpress', d);
    expect(v.roles.map((r) => r.role)).toEqual(['register', 'run', 'classes-and-state', 'other']);
    expect(v.roles[0]?.members.map((m) => m.id)).toEqual(['function:add_filter']);
    expect(v.roles[3]?.members.map((m) => m.id)).toEqual(['filter:the_content']);
    const hook = v.roles[2]?.members.find((m) => m.id === 'class:WP_Hook');
    expect(hook?.methods?.map((m) => [m.id, m.href])).toEqual([
      ['method:WP_Hook::add_filter', '/wordpress/hooks/class/WP_Hook/#add_filter'],
      ['method:WP_Hook::apply_filters', '/wordpress/hooks/class/WP_Hook/#apply_filters'],
    ]);
  });
  test('a member in a cycle is circular', () => {
    const v = seamView('hooks', 'wordpress', d);
    expect(v.roles[0]?.members[0]).toMatchObject({ id: 'function:add_filter', circular: true, href: '/wordpress/hooks/add_filter/', verdict: 'works-with-differences' });
  });
});

describe('symbolView', () => {
  test('add_filter: edges, calls into another seam, fires, examples, content', () => {
    const v = symbolView('function:add_filter', 'wordpress', d);
    expect(v.role).toBe('register');
    expect(v.edges).toContainEqual({ kind: 'writes', label: 'writes', to: { id: 'global:wp_filter', name: 'wp_filter', href: '/wordpress/hooks/global/wp_filter/', circular: false } });
    expect(v.edges).toContainEqual(expect.objectContaining({ label: 'undoes', to: expect.objectContaining({ id: 'function:apply_filters' }) }));
    expect(v.callsInto).toEqual([{ seam: 'Options', symbols: [{ id: 'function:get_option', name: 'get_option', href: '/wordpress/options/get_option/', circular: true }] }]);
    expect(v.fires).toEqual([{ id: 'filter:the_content', name: 'the_content', href: '/wordpress/hooks/filter/the_content/', dynamic: false }]);
    expect(v.examples).toEqual([{ id: 'hooks/add_filter/change-a-value', name: 'change-a-value', title: 'Change a value WordPress passes through a filter.', code: "add_filter( 'excerpt_length', fn() => 20, 999 );\n\nreturn apply_filters( 'excerpt_length', 55 );\n", sides: [{ side: 'wordpress', status: 'passed' }, { side: 'runtime', status: 'passed' }] }]);
    expect(v.content?.slug).toBe('add_filter');
  });
  test('a global is read by the function that reads it', () => {
    const v = symbolView('global:wp_filter', 'wordpress', d);
    expect(v.edges.map((e) => [e.label, e.to.id])).toEqual(expect.arrayContaining([['read by', 'function:apply_filters'], ['written by', 'function:add_filter']]));
  });
  test('a dynamic hook is flagged where it is fired', () => {
    expect(symbolView('function:get_option', 'wordpress', d).fires).toEqual([expect.objectContaining({ id: 'filter:pre_option_{$option}', dynamic: true })]);
  });
  test('a class view carries its methods', () => {
    expect(symbolView('class:WP_Hook', 'wordpress', d).methods?.map((m) => m.id)).toEqual(['method:WP_Hook::add_filter', 'method:WP_Hook::apply_filters']);
  });
  test('an example with no results has not run', async () => {
    const without = { ...d, examples: { ...d.examples, results: null } };
    expect(symbolView('function:add_filter', 'wordpress', without).examples[0]?.sides.map((s) => s.status)).toEqual(['not-run', 'not-run']);
  });
  test('example folders: a slug with / or # uses --', () => {
    expect(exampleFolder('method:WP_Hook::apply_filters')).toBe('class--WP_Hook--apply_filters');
    expect(exampleFolder('filter:the_content')).toBe('filter--the_content');
  });
});

describe('example order', () => {
  test('a porting "before" comes just above its "after"', () => {
    const pair = structuredClone(d);
    const base = pair.examples.files.find((e) => e.seam === 'hooks')!;
    pair.examples.files = ['porting-x-after', 'porting-x-before', 'a-plain-one'].map((name) => ({ ...base, id: `hooks/add_filter/${name}`, name }));
    expect(symbolView('function:add_filter', 'wordpress', pair).examples.map((e) => e.name)).toEqual(['a-plain-one', 'porting-x-before', 'porting-x-after']);
  });
});
