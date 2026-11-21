import { describe, expect, test } from 'bun:test';
import { mkdirSync, mkdtempSync, writeFileSync } from 'node:fs';
import { tmpdir } from 'node:os';
import { dirname, join } from 'node:path';
import type { EvidenceSource } from '@speedyspec-guide/contracts';
import type { Assignment, Inventory, Seam } from '@speedyspec-guide/domain';
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
};

function content(pages: Record<string, string>): string {
  const dir = mkdtempSync(join(tmpdir(), 'content-'));
  for (const [path, body] of Object.entries(pages)) {
    mkdirSync(dirname(join(dir, path)), { recursive: true });
    writeFileSync(join(dir, path), body);
  }
  return dir;
}

const hooks: Seam = { id: 'hooks', name: 'Hooks', job: 'j', ported: true, files: [], symbols: [], exclude: [], roles: {}, edges: [], wordpress: [] };
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
    runtimeTags: [],
    ...over,
  };
}

const rulesOf = async (c: ValidationContext) => (await runRules(ALL_RULES, c)).map((f) => f.rule);

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
    const f = await runRules(ALL_RULES, await ctx({}, { examples: { results: [result('wordpress', true), result('runtime', false, '55')], problems: [], declared: [{ id: 'hooks/add_filter/a', sides: ['wordpress', 'runtime'] }] } }));
    expect(f).toEqual([{ rule: 'ExampleHasRun', where: 'hooks/add_filter/a', message: 'fails on runtime: expected return 20, got 55' }]);
  });

  test('a declared side with no result is a failure', async () => {
    const f = await runRules(ALL_RULES, await ctx({}, { examples: { results: [result('wordpress', true)], problems: [], declared: [{ id: 'hooks/add_filter/a', sides: ['wordpress', 'runtime'] }] } }));
    expect(f).toEqual([{ rule: 'ExampleHasRun', where: 'hooks/add_filter/a', message: 'did not run on runtime' }]);
  });

  test('an examples file from before declared sides were recorded asks to rerun the stage', async () => {
    const stale = { results: [], problems: [] } as unknown as NonNullable<ValidationContext['examples']>;
    expect(await runRules(ALL_RULES, await ctx({}, { examples: stale }))).toEqual([{ rule: 'ExampleHasRun', where: 'generated/examples.json', message: 'written by an older toolchain; run bun run guide examples again' }]);
  });

  test('no examples file means the runner did not run, which is not a failure', async () => {
    expect(await rulesOf(await ctx({}, { examples: null }))).toEqual([]);
  });

  test('a SpeedySpec version with no runtime tag', async () => {
    const r = await rulesOf(await ctx({ 'speedyspec/hooks/a.mdx': '<Changed version="1.2.0"/> <Ev scenario="add_filter_returns_true"/>' }, { runtimeTags: ['1.0.0'] }));
    expect(r).toEqual(['VersionHasTag']);
  });
});
