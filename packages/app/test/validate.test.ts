import { describe, expect, test } from 'bun:test';
import { mkdirSync, mkdtempSync, writeFileSync } from 'node:fs';
import { tmpdir } from 'node:os';
import { dirname, join } from 'node:path';
import type { EvidenceSource } from '@speedyspec-guide/contracts';
import { type Assignment, type Guide, type Inventory, parseCitation, type Seam } from '@speedyspec-guide/domain';
import { ContentFiles } from '../../adapter-content-files/src/index.ts';
import { ALL_RULES, runRules } from '../src/validate/run.ts';
import type { ValidationContext } from '../src/validate/rule.ts';

const sha = (s: string) => new Bun.CryptoHasher('sha256').update(s).digest('hex');
const LINES = 'function add_filter() {';

const evidence: EvidenceSource = {
  scenarioExists: async (_a, n) => n === 'add_filter_returns_true',
  breakExists: async (_a, s) => s === 'wp_filter_replace_wholesale',
  testExists: async () => false,
  sourceLines: async (_b, file, from) => (file === 'wp-includes/plugin.php' && from === 2 ? LINES : null),
  catalogue: async () => null,
  compatVersion: async () => null,
};

function content(pages: Record<string, string>): string {
  const dir = mkdtempSync(join(tmpdir(), 'content-'));
  for (const [path, body] of Object.entries(pages)) {
    mkdirSync(dirname(join(dir, path)), { recursive: true });
    writeFileSync(join(dir, path), body);
  }
  return dir;
}

const hooks: Seam = { id: 'hooks', name: 'Hooks', job: 'j', ported: true, files: [], symbols: [], exclude: [], elsewhere: [], roles: {}, edges: [], wordpress: [] };
const inventory: Inventory = { base: 'wp', version: '7.1.5', symbols: [], edges: [], unresolved: [] };

async function ctx(pages: Record<string, string>, over: Partial<ValidationContext> = {}): Promise<ValidationContext> {
  const c = new ContentFiles(content(pages));
  return {
    inventory,
    assignment: { seamOf: {}, unassigned: [], conflicts: [] },
    seams: [hooks],
    pages: await c.pages(),
    citations: await c.citations(),
    evidence,
    history: { tags: ['7.1.5'], symbols: {} },
    versionsOnPages: await c.versions(),
    config: { requireAllAssigned: false },
    examples: null,
    declaredExamples: [],
    runtimeTags: [],
    evidenceIndex: {},
    runtimeIds: null,
    crossSeam: [],
    guides: [],
    ...over,
  };
}

const rulesOf = async (c: ValidationContext) => (await runRules(ALL_RULES, c)).map((f) => f.rule);

const guide = (over: Partial<Guide>): Guide => ({ file: 'guides/path/01-first.mdx', kind: 'path', slug: 'first', order: 1, title: 'First', summary: 'S.', examples: [], symbols: [], citations: [], ...over });
const withSymbol: Inventory = { ...inventory, symbols: [{ id: 'function:get_option', kind: 'function', name: 'get_option', file: 'wp-includes/option.php', line: 1 } as Inventory['symbols'][number]] };

describe('guide rules', () => {
  test('guide_citations_are_checked', async () => {
    const citations = [
      parseCitation({ source: 'wp:wp-includes/plugin.php#L2', hash: sha('old text') }),
      parseCitation({ source: 'wp:wp-includes/plugin.php#L9' }),
    ];
    const f = await runRules(ALL_RULES, await ctx({}, { guides: [guide({ citations })] }));
    expect(f.filter((x) => x.rule.startsWith('Cit'))).toEqual([
      { rule: 'CitationExists', where: 'guides/path/01-first.mdx', message: 'wp:wp-includes/plugin.php#L9 does not exist at the pinned versions' },
      { rule: 'CitedLinesUnchanged', where: 'guides/path/01-first.mdx', message: `wp:wp-includes/plugin.php#L2 changed since it was cited; re-read it, then set hash="${sha(LINES)}"` },
    ]);
  });

  test('guide_example_citation_needs_only_to_exist', async () => {
    const citations = [parseCitation({ example: 'hooks/add_filter/a' }), parseCitation({ example: 'hooks/nope/x' })];
    const f = await runRules(ALL_RULES, await ctx({}, { guides: [guide({ citations })], declaredExamples: [{ id: 'hooks/add_filter/a', sides: ['wordpress'] }] }));
    expect(f.filter((x) => x.rule === 'CitationExists').map((x) => x.message)).toEqual(['example hooks/nope/x does not exist in seams/*/examples']);
  });

  test('guide_rules_pass_for_good_guides', async () => {
    const guides = [guide({ examples: ['hooks/add_filter/a'], symbols: ['function:get_option'] }), guide({ file: 'guides/topics/hooks.mdx', kind: 'topic', slug: 'hooks', seam: 'hooks', order: undefined })];
    expect(await rulesOf(await ctx({}, { guides, inventory: withSymbol, declaredExamples: [{ id: 'hooks/add_filter/a', sides: ['wordpress'] }], examples: { results: [], problems: [], declared: [] } }))).not.toContain('GuideExampleExists');
    const f = await runRules(ALL_RULES, await ctx({}, { guides, inventory: withSymbol, declaredExamples: [{ id: 'hooks/add_filter/a', sides: ['wordpress'] }] }));
    expect(f.filter((x) => x.rule.startsWith('Guide'))).toEqual([]);
  });

  test('guide_example_exists_reports_missing_ids', async () => {
    const f = await runRules(ALL_RULES, await ctx({}, { guides: [guide({ examples: ['options/nope/x'] })] }));
    expect(f.filter((x) => x.rule === 'GuideExampleExists')).toEqual([{ rule: 'GuideExampleExists', where: 'guides/path/01-first.mdx', message: 'embeds options/nope/x, which is no example' }]);
  });

  test('guide_symbol_resolves_reports_unknown_ids', async () => {
    const f = await runRules(ALL_RULES, await ctx({}, { inventory: withSymbol, guides: [guide({ symbols: ['function:get_option', 'function:nope'] })] }));
    expect(f.filter((x) => x.rule === 'GuideSymbolResolves')).toEqual([{ rule: 'GuideSymbolResolves', where: 'guides/path/01-first.mdx', message: 'links function:nope, which is no symbol' }]);
  });

  test('guide_topic_seam_exists', async () => {
    const f = await runRules(ALL_RULES, await ctx({}, { guides: [guide({ file: 'guides/topics/nope.mdx', kind: 'topic', slug: 'nope', seam: 'nope', order: undefined })] }));
    expect(f.filter((x) => x.rule === 'GuideTopicSeamExists')).toEqual([{ rule: 'GuideTopicSeamExists', where: 'guides/topics/nope.mdx', message: 'is a topic guide for nope, which is no seam' }]);
  });

  test('guide_topic_for_the_guides_seam_fails', async () => {
    const guidesSeam: Seam = { ...hooks, id: 'guides', name: 'Guides', ported: false };
    const f = await runRules(ALL_RULES, await ctx({}, { seams: [hooks, guidesSeam], guides: [guide({ file: 'guides/topics/guides.mdx', kind: 'topic', slug: 'guides', seam: 'guides', order: undefined })] }));
    expect(f.filter((x) => x.rule === 'GuideTopicSeamExists')).toEqual([{ rule: 'GuideTopicSeamExists', where: 'guides/topics/guides.mdx', message: 'is a topic guide for guides, which is no seam' }]);
  });

  test('guide_front_and_order_reports_shared_slugs', async () => {
    const guides = [guide({}), guide({ file: 'guides/path/02-first.mdx', order: 2 })];
    const f = (await runRules(ALL_RULES, await ctx({}, { guides }))).filter((x) => x.rule === 'GuideFrontAndOrder');
    expect(f).toEqual([
      { rule: 'GuideFrontAndOrder', where: 'guides/path/01-first.mdx', message: 'shares slug first with guides/path/02-first.mdx' },
      { rule: 'GuideFrontAndOrder', where: 'guides/path/02-first.mdx', message: 'shares slug first with guides/path/01-first.mdx' },
    ]);
  });

  test('guide_front_and_order_reports_duplicates_on_both', async () => {
    const guides = [
      guide({}),
      guide({ file: 'guides/path/01-again.mdx', slug: 'again' }),
      guide({ file: 'guides/path/plain.mdx', slug: 'plain', order: undefined, title: '' }),
      guide({ file: 'guides/contributing/wordpress/01-change.mdx', kind: 'contributing', part: 'wordpress', slug: 'change' }),
    ];
    const f = (await runRules(ALL_RULES, await ctx({}, { guides }))).filter((x) => x.rule === 'GuideFrontAndOrder');
    expect(f).toEqual([
      { rule: 'GuideFrontAndOrder', where: 'guides/path/01-first.mdx', message: 'shares number 1 with guides/path/01-again.mdx' },
      { rule: 'GuideFrontAndOrder', where: 'guides/path/01-again.mdx', message: 'shares number 1 with guides/path/01-first.mdx' },
      { rule: 'GuideFrontAndOrder', where: 'guides/path/plain.mdx', message: 'needs a title and a summary' },
      { rule: 'GuideFrontAndOrder', where: 'guides/path/plain.mdx', message: 'needs an nn- number prefix' },
    ]);
  });
});

describe('rules', () => {
  test('a clean page passes', async () => {
    expect(await rulesOf(await ctx({ 'speedyspec/hooks/add_filter.mdx': '<Ev scenario="add_filter_returns_true"/> <Ev break="wp_filter_replace_wholesale"/>' }))).toEqual([]);
  });

  test('a symbol in two seams', async () => {
    const assignment: Assignment = { seamOf: {}, unassigned: [], conflicts: [{ symbol: 'filter:h', seams: ['a', 'b'] }] };
    const f = await runRules(ALL_RULES, await ctx({}, { assignment }));
    expect(f).toEqual([{ rule: 'EverySymbolInOneSeam', where: 'filter:h', message: 'claimed by seams a, b' }]);
  });

  test('an unassigned symbol fails only when every symbol must be assigned', async () => {
    const assignment: Assignment = { seamOf: {}, unassigned: ['function:lost'], conflicts: [] };
    expect(await rulesOf(await ctx({}, { assignment }))).toEqual([]);
    expect(await rulesOf(await ctx({}, { assignment, config: { requireAllAssigned: true } }))).toEqual(['EverySymbolInOneSeam']);
  });

  test('a citation of a missing scenario', async () => {
    expect(await rulesOf(await ctx({ 'speedyspec/hooks/a.mdx': '<Ev scenario="nope"/>' }))).toEqual(['CitationExists']);
  });

  test('a seam edge citing missing lines', async () => {
    const seams: Seam[] = [{ ...hooks, edges: [{ from: 'a', to: 'b', kind: 'calls', at: { kind: 'source', base: 'wp', file: 'x.php', from: 1, to: 1, hash: 'h' } }] }];
    expect(await rulesOf(await ctx({}, { seams }))).toContain('CitationExists');
  });

  test('cited lines that changed since they were cited', async () => {
    expect(await rulesOf(await ctx({ 'wordpress/hooks/a.mdx': `<Ev source="wp:wp-includes/plugin.php#L2" hash="${sha('old text')}"/>` }))).toEqual(['CitedLinesUnchanged']);
  });

  test('a source citation without a hash gets the hash to add', async () => {
    const f = await runRules(ALL_RULES, await ctx({ 'wordpress/hooks/a.mdx': '<Ev source="wp:wp-includes/plugin.php#L2"/>' }));
    expect(f).toEqual([{ rule: 'CitedLinesUnchanged', where: 'wordpress/hooks/a.mdx', message: `wp:wp-includes/plugin.php#L2 has no hash; add hash="${sha(LINES)}"` }]);
  });

  test('a SpeedySpec page of a ported seam that cites only source', async () => {
    expect(await rulesOf(await ctx({ 'speedyspec/hooks/a.mdx': `<Ev source="wp:wp-includes/plugin.php#L2" hash="${sha(LINES)}"/>` }))).toEqual(['PortedSeamVerified']);
  });

  test('a SpeedySpec page of a ported seam with no citations at all', async () => {
    expect(await rulesOf(await ctx({ 'speedyspec/hooks/empty.mdx': '# add_filter\n\nNothing cited.' }))).toEqual(['PortedSeamVerified']);
  });

  test('a WordPress page citing SpeedySpec code', async () => {
    const r = await rulesOf(await ctx({ 'wordpress/hooks/a.mdx': '<Ev scenario="add_filter_returns_true"/> <Ev source="ss:x.php#L1" hash="h"/>' }));
    expect(r).toContain('WordPressPagesCiteWordPress');
  });

  test('a WordPress version with no tag', async () => {
    expect(await rulesOf(await ctx({ 'wordpress/hooks/a.mdx': '<Changed version="9.9.9" base="wp"/> <Ev scenario="add_filter_returns_true"/>' }))).toEqual(['VersionHasTag']);
  });

  test('every rule reports in one run', async () => {
    const r = await rulesOf(await ctx({
      'speedyspec/hooks/a.mdx': '<Ev scenario="nope"/>',
      'wordpress/hooks/b.mdx': '<Changed version="9.9.9" base="wp"/> <Ev source="ss:x.php#L1" hash="h"/>',
    }));
    expect(new Set(r)).toEqual(new Set(['CitationExists', 'VersionHasTag', 'WordPressPagesCiteWordPress']));
  });
});

describe('examples', () => {
  const expected = { output: '', return: '20', error: null };
  const result = (side: 'wordpress' | 'runtime', passed: boolean, ret = '20') => ({ id: 'hooks/add_filter/a', side, passed, actual: { ...expected, return: ret }, expected });

  test('a problem with an example file is a failure', async () => {
    const f = await runRules(ALL_RULES, await ctx({}, { examples: { results: [], problems: [{ where: '/s/b.php', message: 'has no b.expect.json' }], declared: [] } }));
    expect(f).toEqual([{ rule: 'ExampleHasRun', where: '/s/b.php', message: 'has no b.expect.json' }]);
  });

  test('a failed run names the side and what differed', async () => {
    const f = await runRules(ALL_RULES, await ctx({}, { examples: { results: [result('wordpress', true), result('runtime', false, '55')], problems: [], declared: [] }, declaredExamples: [{ id: 'hooks/add_filter/a', sides: ['wordpress', 'runtime'] }] }));
    expect(f).toEqual([{ rule: 'ExampleHasRun', where: 'hooks/add_filter/a', message: 'fails on runtime: expected return 20, got 55' }]);
  });

  test('a declared side with no result is a failure', async () => {
    const f = await runRules(ALL_RULES, await ctx({}, { examples: { results: [result('wordpress', true)], problems: [], declared: [] }, declaredExamples: [{ id: 'hooks/add_filter/a', sides: ['wordpress', 'runtime'] }] }));
    expect(f).toEqual([{ rule: 'ExampleHasRun', where: 'hooks/add_filter/a', message: 'did not run on runtime' }]);
  });

  test('an example on disk that is not in the results did not run', async () => {
    const f = await runRules(ALL_RULES, await ctx({}, { examples: { results: [result('wordpress', true)], problems: [], declared: [] }, declaredExamples: [{ id: 'hooks/add_filter/a', sides: ['wordpress'] }, { id: 'hooks/add_filter/new', sides: ['wordpress'] }] }));
    expect(f).toEqual([{ rule: 'ExampleHasRun', where: 'hooks/add_filter/new', message: 'did not run on wordpress' }]);
  });

  test('examples on disk with no results at all is a failure saying how to run them', async () => {
    const f = await runRules(ALL_RULES, await ctx({}, { examples: null, declaredExamples: [{ id: 'hooks/add_filter/a', sides: ['wordpress'] }] }));
    expect(f).toEqual([{ rule: 'ExampleHasRun', where: 'generated/examples.json', message: '1 example has not run: bun run runner:build && bun run guide examples' }]);
  });

  test('no examples file and no examples is not a failure', async () => {
    expect(await rulesOf(await ctx({}, { examples: null }))).toEqual([]);
  });

  test('a SpeedySpec version with no runtime tag', async () => {
    const r = await rulesOf(await ctx({ 'speedyspec/hooks/a.mdx': '<Changed version="1.2.0"/> <Ev scenario="add_filter_returns_true"/>' }, { runtimeTags: ['1.0.0'] }));
    expect(r).toEqual(['VersionHasTag']);
  });
});

describe('SeamSymbolsExist', () => {
  test('a seam listing an id neither WordPress nor the runtime has is a failure', async () => {
    const seams: Seam[] = [{ ...hooks, symbols: ['global:wp_filter', 'class:SpeedySpec\\WpHooks\\HookStorage', 'global:wp_fitler'] }];
    const inv: Inventory = { ...inventory, symbols: [{ id: 'global:wp_filter', kind: 'global', name: 'wp_filter', file: 'p.php', line: 1 }] };
    const f = await runRules(ALL_RULES, await ctx({}, { seams, inventory: inv, runtimeIds: ['class:SpeedySpec\\WpHooks\\HookStorage'] }));
    expect(f).toEqual([{ rule: 'SeamSymbolsExist', where: 'seams/hooks/seam.yaml', message: 'lists global:wp_fitler, which neither WordPress nor the runtime has' }]);
  });
  test('without the runtime inventory, only ids that look like WordPress are checked', async () => {
    const seams: Seam[] = [{ ...hooks, symbols: ['class:SpeedySpec\\WpHooks\\HookStorage'] }];
    expect(await rulesOf(await ctx({}, { seams, runtimeIds: null }))).toEqual([]);
  });
});

describe('example citations', () => {
  const runs = (sides: ('wordpress' | 'runtime')[]) => ({ declaredExamples: [{ id: 'hooks/x/declared', sides }] });
  test('an_example_citation_must_name_a_declared_example', async () => {
    const f = await runRules(ALL_RULES, await ctx({ 'speedyspec/hooks/a.mdx': '<Ev example="hooks/x/missing"/>' }, runs(['wordpress', 'runtime'])));
    expect(f.find((x) => x.rule === 'CitationExists')?.message).toContain('example hooks/x/missing');
  });
  test('an_example_citation_must_run_on_the_runtime', async () => {
    const f = await runRules(ALL_RULES, await ctx({ 'speedyspec/hooks/a.mdx': '<Ev example="hooks/x/declared"/>' }, runs(['wordpress'])));
    expect(f.find((x) => x.rule === 'CitationExists')?.message).toContain('does not run on the runtime');
  });
  test('a_wordpress_page_cites_an_example_that_runs_on_wordpress', async () => {
    const ok = await runRules(ALL_RULES, await ctx({ 'wordpress/hooks/a.mdx': '<Ev example="hooks/x/declared"/>' }, runs(['wordpress'])));
    expect(ok.filter((x) => x.rule === 'CitationExists')).toEqual([]);
    const bad = await runRules(ALL_RULES, await ctx({ 'wordpress/hooks/a.mdx': '<Ev example="hooks/x/declared"/>' }, runs(['runtime'])));
    expect(bad.find((x) => x.rule === 'CitationExists')?.message).toContain('does not run on WordPress');
  });
  test('an_example_that_runs_on_the_runtime_is_verified_evidence', async () => {
    const f = await runRules(ALL_RULES, await ctx({ 'speedyspec/hooks/a.mdx': '<Ev example="hooks/x/declared"/>' }, runs(['wordpress', 'runtime'])));
    expect(f.filter((x) => x.rule === 'CitationExists' || x.rule === 'PortedSeamVerified')).toEqual([]);
  });
});

describe('runtime members of a seamed class', () => {
  const wp: Inventory = { ...inventory, symbols: [{ id: 'class:C', kind: 'class', name: 'C', file: 'c.php', line: 1 }] };
  const assignment = { seamOf: { 'class:C': 'hooks' }, unassigned: [], conflicts: [] };
  test('runtime_method_of_a_seamed_class_must_be_listed', async () => {
    const f = await runRules(ALL_RULES, await ctx({}, { inventory: wp, assignment, runtimeIds: ['class:C', 'method:C::extra'] }));
    expect(f.find((x) => x.rule === 'RuntimeMembersListed')?.message).toContain('method:C::extra');
  });
  test('a_listed_runtime_method_passes', async () => {
    const f = await runRules(ALL_RULES, await ctx({}, { inventory: wp, assignment, seams: [{ ...hooks, symbols: ['method:C::extra'] }], runtimeIds: ['class:C', 'method:C::extra'] }));
    expect(f.filter((x) => x.rule === 'RuntimeMembersListed')).toEqual([]);
  });
});

describe('dependency states', () => {
  const cross = [{ from: 'function:a', to: 'function:t', kind: 'calls', fromSeam: 'hooks', toSeam: 'support' }];
  const cite = { kind: 'source' as const, base: 'ss' as const, file: 'crates/x/src/a.rs', from: 1, to: 1, hash: 'h' };
  test('ported_seam_missing_a_state_fails', async () => {
    const f = await runRules(ALL_RULES, await ctx({}, { crossSeam: cross }));
    expect(f.find((x) => x.rule === 'DependencyStateRecorded')?.message).toBe('hooks: function:t has no recorded state');
  });
  test('state_for_a_non_dependency_fails', async () => {
    const seams = [{ ...hooks, dependencies: { 'function:t': { state: 'port' as const, cite }, 'function:u': { state: 'rust' as const, cite } } }];
    const f = await runRules(ALL_RULES, await ctx({}, { crossSeam: cross, seams }));
    expect(f.filter((x) => x.rule === 'DependencyStateRecorded').map((x) => x.message)).toEqual(['hooks: function:u is not a dependency']);
  });
  test('an_unported_seam_need_not_record_states', async () => {
    const f = await runRules(ALL_RULES, await ctx({}, { crossSeam: cross, seams: [{ ...hooks, ported: false }] }));
    expect(f.filter((x) => x.rule === 'DependencyStateRecorded')).toEqual([]);
  });
});

describe('runtime symbols in two seams', () => {
  test('runtime_symbol_in_two_seams_fails', async () => {
    const seams = [{ ...hooks, symbols: ['class:SpeedySpec\\X'] }, { ...hooks, id: 'container', name: 'Container', symbols: ['class:SpeedySpec\\X'] }];
    const f = await runRules(ALL_RULES, await ctx({}, { seams, runtimeIds: ['class:SpeedySpec\\X'] }));
    expect(f.find((x) => x.rule === 'EverySymbolInOneSeam')?.message).toBe('claimed by seams container, hooks');
  });
});

describe('runtime members of a runtime class a seam lists', () => {
  test('a_method_of_a_listed_runtime_class_must_be_listed', async () => {
    const f = await runRules(ALL_RULES, await ctx({}, { seams: [{ ...hooks, symbols: ['class:SpeedySpec\\R'] }], runtimeIds: ['class:SpeedySpec\\R', 'method:SpeedySpec\\R::m'] }));
    expect(f.find((x) => x.rule === 'RuntimeMembersListed')?.message).toContain('method:SpeedySpec\\R::m');
  });
});

describe('seam files', () => {
  const wp: Inventory = { ...inventory, symbols: [{ id: 'function:f', kind: 'function', name: 'f', file: 'wp-includes/f.php', line: 1 }] };
  test('seam_file_missing_from_wordpress_fails', async () => {
    const f = await runRules(ALL_RULES, await ctx({}, { inventory: wp, seams: [{ ...hooks, id: 'x', files: ['wp-includes/f.php', 'wp-includes/nope.php'] }] }));
    expect(f.filter((x) => x.rule === 'SeamFilesExist').map((x) => `${x.where}: ${x.message}`)).toEqual(["seams/x/seam.yaml: lists wp-includes/nope.php, which WordPress doesn't have"]);
  });
  test('a_glob_is_not_checked_for_existence', async () => {
    const f = await runRules(ALL_RULES, await ctx({}, { inventory: wp, seams: [{ ...hooks, files: ['wp-admin/**', 'wp-includes/*.php'] }] }));
    expect(f.filter((x) => x.rule === 'SeamFilesExist')).toEqual([]);
  });
});

describe('a documented seam', () => {
  const options: Seam = { ...hooks, id: 'options', ported: false };
  const assignment: Assignment = { seamOf: { 'function:get_option': 'options', 'filter:option_{$option}': 'options' }, unassigned: [], conflicts: [] };
  const pages = { 'wordpress/options/get_option.mdx': '---\nsymbol: function:get_option\n---\nx', 'wordpress/options/filter/option_{option}.mdx': '---\nsymbol: "filter:option_{$option}"\n---\nx' };
  const ran = (passed: boolean) => ({ results: [{ id: 'options/get_option/a', side: 'wordpress' as const, passed, actual: { output: '', return: '1', error: null }, expected: { output: '', return: '1', error: null } }], problems: [], declared: [] });
  const covered = async (over: Partial<ValidationContext>) =>
    (await runRules(ALL_RULES, await ctx(pages, { seams: [options], assignment, config: { requireAllAssigned: false, requireWordPressCoverage: ['options'] }, ...over }))).filter((f) => f.rule === 'DocumentedSeamCovered');

  test('a_function_with_a_page_but_no_example_fails', async () => {
    expect(await covered({ examples: { results: [], problems: [], declared: [] } })).toEqual([
      { rule: 'DocumentedSeamCovered', where: 'function:get_option', message: 'the options seam is documented: function:get_option needs an example run on WordPress' },
    ]);
  });

  test('a_member_without_a_page_fails', async () => {
    const f = await covered({ examples: ran(true), pages: (await ctx({ 'wordpress/options/get_option.mdx': '---\nsymbol: function:get_option\n---\nx' })).pages });
    expect(f).toEqual([{ rule: 'DocumentedSeamCovered', where: 'filter:option_{$option}', message: 'the options seam is documented: filter:option_{$option} needs a WordPress page' }]);
  });

  test('a_page_and_a_passing_example_pass', async () => {
    expect(await covered({ examples: ran(true) })).toEqual([]);
  });

  test('a_failing_example_does_not_count', async () => {
    expect((await covered({ examples: ran(false) })).map((f) => f.where)).toEqual(['function:get_option']);
  });
});
