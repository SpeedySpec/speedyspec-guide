import { describe, expect, test } from 'bun:test';
import { mkdtempSync } from 'node:fs';
import { tmpdir } from 'node:os';
import { join } from 'node:path';
import { readGuideData } from '../src/model/data.ts';

const fixtures = join(import.meta.dir, 'fixtures');
const env = { GUIDE_DATA_DIR: join(fixtures, 'generated'), GUIDE_SEAMS_DIR: join(fixtures, 'seams'), GUIDE_CONTENT_DIR: join(fixtures, 'content') };

describe('readGuideData', () => {
  test('reads generated data, seams with their extra fields, examples and content', async () => {
    const d = await readGuideData(env);
    expect(d.inventory.symbols.some((s) => s.id === 'function:add_filter')).toBe(true);
    expect(d.runtime.map((s) => s.id)).toContain('class:SpeedySpec\\Hooks\\Hook');
    const hooks = d.seams.find((s) => s.id === 'hooks')!;
    expect(hooks).toMatchObject({ crates: ['speedyspec-wp-hooks', 'speedyspec-wp-hooks-php'], dependencies: {} });
    expect(d.seams.find((s) => s.id === 'options')?.dependencies).toEqual({ 'function:add_filter': { state: 'php', cite: { kind: 'scenario', area: 'hooks', name: 'add_filter_returns_true' } } });
    expect(d.examples.files.map((e) => e.id)).toEqual(['hooks/add_filter/change-a-value']);
    expect(d.examples.results?.results).toHaveLength(2);
    expect(d.content.find((c) => c.section === 'wordpress' && c.slug === 'add_filter')).toMatchObject({ seam: 'hooks', kind: 'symbol', symbol: 'function:add_filter' });
    expect(d.content.find((c) => c.slug === '_seam')).toMatchObject({ kind: 'seam', seam: 'hooks' });
    expect(d.content.find((c) => c.symbol === 'class:WP_Hook')).toMatchObject({ section: 'speedyspec', seam: 'hooks', slug: 'class/WP_Hook', kind: 'symbol' });
    expect(d.content.find((c) => c.section === 'speedyspec')?.data).toMatchObject({ verdict: 'works-with-differences' });
    expect(d.cycles.components).toEqual([['function:add_filter', 'function:get_option']]);
  });

  test('missing data gives empty values', async () => {
    const empty = () => mkdtempSync(join(tmpdir(), 'guide-empty-'));
    const d = await readGuideData({ GUIDE_DATA_DIR: empty(), GUIDE_SEAMS_DIR: empty(), GUIDE_CONTENT_DIR: empty(), GUIDE_ALLOW_EMPTY: '1' });
    expect(d.inventory.symbols).toEqual([]);
    expect(d.seams).toEqual([]);
    expect(d.wordpressHistory).toBeNull();
    expect(d.examples).toEqual({ files: [], results: null });
    expect(d.cycles).toEqual({ symbol: [], seam: [], components: [] });
  });

  test('a seam folder with a reserved name is refused', async () => {
    const { SeamFiles } = await import('../../packages/adapter-seam-files/src/index.ts');
    const dir = mkdtempSync(join(tmpdir(), 'guide-reserved-'));
    await Bun.write(join(dir, 'runtime', 'seam.yaml'), 'name: R\njob: x\n');
    await expect(new SeamFiles(dir).all()).rejects.toThrow(/runtime.*reserved/);
  });
});
