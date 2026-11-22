import { describe, expect, test } from 'bun:test';
import type { Assignment, ContentPage, Seam } from '@speedyspec-guide/domain';
import { buildEvidenceIndex } from '../src/evidence-index.ts';
import type { ValidationContext } from '../src/validate/rule.ts';
import { CitesItsScenario } from '../src/validate/rules.ts';

const catalogue = {
  scenarios: [
    { name: 'add_then_apply', steps: [{ call: 'add_filter' }, { call: 'apply_filters' }] },
    { name: 'hook_object', steps: [{ call: 'new WP_Hook' }, { call: '$h->apply_filters' }, { call: 'WP_Hook::build_preinitialized_hooks' }] },
    { name: 'globals', steps: [{ call: 'add_filter' }, { call: 'global:replace', args: ['wp_filter', []] }, { call: 'global:read', args: ['wp_filters'] }] },
  ],
  breaks: [
    { scenario: 'globals', step: 1, why: 'Replacing $wp_filter wholesale.' },
    { scenario: 'hook_object', why: 'Whole scenario.' },
  ],
};

describe('buildEvidenceIndex', () => {
  const index = buildEvidenceIndex('hooks', catalogue);
  test('maps every call form to its symbol', () => {
    expect(index['function:add_filter']?.scenarios).toEqual(['add_then_apply', 'globals']);
    expect(index['function:apply_filters']?.scenarios).toEqual(['add_then_apply']);
    expect(index['class:WP_Hook']?.scenarios).toEqual(['hook_object']);
    expect(index['method:WP_Hook::apply_filters']?.scenarios).toEqual(['hook_object']);
    expect(index['method:WP_Hook::build_preinitialized_hooks']?.scenarios).toEqual(['hook_object']);
    expect(index['global:wp_filter']?.scenarios).toEqual(['globals']);
    expect(index['global:wp_filters']?.scenarios).toEqual(['globals']);
  });
  test('a break with a step goes under that step only; without one, under every symbol of its scenario', () => {
    expect(index['global:wp_filter']?.breaks.map((b) => b.scenario)).toEqual(['globals']);
    expect(index['function:add_filter']?.breaks).toEqual([]);
    expect(index['class:WP_Hook']?.breaks.map((b) => b.scenario)).toEqual(['hook_object']);
    expect(index['method:WP_Hook::apply_filters']?.breaks.map((b) => b.scenario)).toEqual(['hook_object']);
  });
});

describe('a kept object in the object cache area', () => {
  test('is_a_WP_Object_Cache', () => {
    const index = buildEvidenceIndex('object-cache', { scenarios: [{ name: 'own', steps: [{ call: '$c->get' }] }], breaks: [] });
    expect(index['method:WP_Object_Cache::get']?.scenarios).toEqual(['own']);
  });
});

describe('a scenario step that hooks a name', () => {
  const hooks = [
    { id: 'filter:pre_option_{$option}', name: 'pre_option_{$option}' },
    { id: 'filter:{$hook_name}', name: '{$hook_name}' },
    { id: 'action:init', name: 'init' },
    { id: 'filter:pre_{$field}', name: 'pre_{$field}' },
    { id: 'action:{$old}_{$new}', name: '{$old}_{$new}' },
    { id: 'action:update_option', name: 'update_option' },
  ];
  const hooked = {
    scenarios: [
      { name: 'pre_option', steps: [{ call: 'add_filter', args: ['pre_option_blogname', {}] }] },
      { name: 'on_init', steps: [{ call: 'add_action', args: ['init', {}] }, { call: 'has_filter', args: [5] }] },
      { name: 'on_update', steps: [{ call: 'add_action', args: ['update_option', {}] }] },
    ],
    breaks: [],
  };
  const index = buildEvidenceIndex('options', hooked, hooks);
  test('counts_toward_the_hooks_page_its_name_matches', () => {
    expect(index['filter:pre_option_{$option}']?.scenarios).toEqual(['pre_option']);
    expect(index['function:add_filter']?.scenarios).toEqual(['pre_option']);
    expect(index['action:init']?.scenarios).toEqual(['on_init']);
  });
  test('only_the_most_specific_hook_counts', () => {
    expect(index['filter:pre_{$field}']).toBeUndefined();
    expect(index['action:{$old}_{$new}']).toBeUndefined();
    expect(index['action:update_option']?.scenarios).toEqual(['on_update']);
  });
  test('a_name_that_is_only_a_placeholder_matches_nothing', () => {
    expect(index['filter:{$hook_name}']).toBeUndefined();
  });
});

describe('a recorder that never fired', () => {
  const hooks = [{ id: 'action:updated_option', name: 'updated_option' }, { id: 'filter:pre_option_{$option}', name: 'pre_option_{$option}' }];
  const recorded = {
    scenarios: [{ name: 'adds', steps: [{ call: 'add_action', args: ['updated_option', { label: 'rec:updated_option' }] }, { call: 'add_filter', args: ['pre_option_fresh', { label: 'rec:pre_option_fresh' }] }, { call: 'update_option' }] }],
    breaks: [],
    fired: { adds: ['rec:pre_option_fresh'] },
  };
  const index = buildEvidenceIndex('options', recorded, hooks);
  test('a_scenario_counts_for_a_hook_only_when_its_recorder_fired', () => {
    expect(index['filter:pre_option_{$option}']?.scenarios).toEqual(['adds']);
    expect(index['action:updated_option']).toBeUndefined();
  });
  test('the_hook_api_call_still_counts_for_its_function', () => {
    expect(index['function:add_action']?.scenarios).toEqual(['adds']);
  });
});

describe('CitesItsScenario', () => {
  const seams: Seam[] = [{ id: 'hooks', name: 'Hooks', job: 'j', ported: true, files: [], symbols: [], exclude: [], elsewhere: [], roles: {}, edges: [], wordpress: [] }];
  const assignment: Assignment = { seamOf: { 'function:add_filter': 'hooks', 'class:WP_Hook': 'hooks', 'method:WP_Hook::apply_filters': 'hooks' }, unassigned: [], conflicts: [] };
  const page = (symbol: string): ContentPage => ({ page: `speedyspec/hooks/${symbol}.mdx`, section: 'speedyspec', seam: 'hooks', symbol });
  const ctx = (symbol: string, citation: object) =>
    ({ seams, assignment, pages: [page(symbol)], citations: [{ ...page(symbol), citation }], evidenceIndex: { hooks: buildEvidenceIndex('hooks', catalogue) } }) as unknown as ValidationContext;

  test('a page citing a scenario that does not exercise its symbol fails, naming candidates', async () => {
    const f = await CitesItsScenario.check(ctx('function:add_filter', { kind: 'scenario', area: 'hooks', name: 'hook_object' }));
    expect(f).toEqual([{ rule: 'CitesItsScenario', where: 'speedyspec/hooks/function:add_filter.mdx', message: 'cites no scenario that exercises function:add_filter; candidates: add_then_apply, globals' }]);
  });
  test('a matching scenario or break passes', async () => {
    expect(await CitesItsScenario.check(ctx('function:add_filter', { kind: 'scenario', area: 'hooks', name: 'globals' }))).toEqual([]);
    expect(await CitesItsScenario.check(ctx('class:WP_Hook', { kind: 'break', area: 'hooks', scenario: 'hook_object' }))).toEqual([]);
  });
  test('a_wordpress_page_citing_an_unrelated_scenario_fails', async () => {
    const wp = { page: 'wordpress/hooks/add_filter.mdx', section: 'wordpress', seam: 'hooks', symbol: 'function:add_filter' } as ContentPage;
    const c = { seams, assignment, pages: [wp], citations: [{ ...wp, citation: { kind: 'scenario', area: 'hooks', name: 'hook_object' } }], evidenceIndex: { hooks: buildEvidenceIndex('hooks', catalogue) } } as unknown as ValidationContext;
    expect((await CitesItsScenario.check(c)).map((x) => x.where)).toEqual(['wordpress/hooks/add_filter.mdx']);
  });
  test('a_wordpress_page_citing_only_source_passes', async () => {
    const wp = { page: 'wordpress/hooks/add_filter.mdx', section: 'wordpress', seam: 'hooks', symbol: 'function:add_filter' } as ContentPage;
    const c = { seams, assignment, pages: [wp], citations: [{ ...wp, citation: { kind: 'source', base: 'wp', file: 'wp-includes/plugin.php', from: 1, to: 2 } }], evidenceIndex: { hooks: buildEvidenceIndex('hooks', catalogue) } } as unknown as ValidationContext;
    expect(await CitesItsScenario.check(c)).toEqual([]);
  });
  test('a_wordpress_page_of_an_unported_seam_is_checked_against_its_area', async () => {
    const options: Seam = { ...seams[0]!, id: 'options', ported: false };
    const wp = { page: 'wordpress/options/get_option.mdx', section: 'wordpress', seam: 'options', symbol: 'function:get_option' } as ContentPage;
    const idx = buildEvidenceIndex('options', { scenarios: [{ name: 'reads', steps: [{ call: 'get_option' }] }, { name: 'other', steps: [{ call: 'add_option' }] }], breaks: [] });
    const c = { seams: [options], assignment, pages: [wp], citations: [{ ...wp, citation: { kind: 'scenario', area: 'options', name: 'other' } }], evidenceIndex: { options: idx } } as unknown as ValidationContext;
    expect((await CitesItsScenario.check(c)).map((x) => x.message)).toEqual(['cites no scenario that exercises function:get_option; candidates: reads']);
  });
  test("a class page may cite one of its methods' scenarios", async () => {
    const onlyMethod = { ...catalogue, scenarios: [{ name: 'method_only', steps: [{ call: '$h->apply_filters' }] }], breaks: [] };
    const c = ctx('class:WP_Hook', { kind: 'scenario', area: 'hooks', name: 'method_only' });
    (c as unknown as { evidenceIndex: object }).evidenceIndex = { hooks: buildEvidenceIndex('hooks', onlyMethod) };
    expect(await CitesItsScenario.check(c)).toEqual([]);
  });
});
