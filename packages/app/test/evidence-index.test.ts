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

describe('CitesItsScenario', () => {
  const seams: Seam[] = [{ id: 'hooks', name: 'Hooks', job: 'j', ported: true, files: [], symbols: [], exclude: [], roles: {}, edges: [], wordpress: [] }];
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
  test("a class page may cite one of its methods' scenarios", async () => {
    const onlyMethod = { ...catalogue, scenarios: [{ name: 'method_only', steps: [{ call: '$h->apply_filters' }] }], breaks: [] };
    const c = ctx('class:WP_Hook', { kind: 'scenario', area: 'hooks', name: 'method_only' });
    (c as unknown as { evidenceIndex: object }).evidenceIndex = { hooks: buildEvidenceIndex('hooks', onlyMethod) };
    expect(await CitesItsScenario.check(c)).toEqual([]);
  });
});
