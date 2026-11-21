import { beforeAll, describe, expect, test } from 'bun:test';
import { join } from 'node:path';
import { type GuideData, readGuideData } from '../src/model/data.ts';
import { speedyspecPaths, wordpressPaths } from '../src/model/sections.ts';
import { pageOf, seamView, symbolView } from '../src/model/views.ts';

const fixtures = join(import.meta.dir, 'fixtures');
let d: GuideData;
beforeAll(async () => {
  d = await readGuideData({ GUIDE_DATA_DIR: join(fixtures, 'generated'), GUIDE_SEAMS_DIR: join(fixtures, 'seams'), GUIDE_CONTENT_DIR: join(fixtures, 'content') });
});

async function withRuntimeListed(): Promise<GuideData> {
  const dir = join(fixtures, 'seams');
  const { mkdtempSync, cpSync, readFileSync, writeFileSync } = await import('node:fs');
  const { tmpdir } = await import('node:os');
  const seams = mkdtempSync(join(tmpdir(), 'guide-seams-'));
  cpSync(dir, seams, { recursive: true });
  const file = join(seams, 'hooks', 'seam.yaml');
  writeFileSync(file, readFileSync(file, 'utf8').replace('symbols: [global:wp_filter]', 'symbols: [global:wp_filter, "class:SpeedySpec\\\\Hooks\\\\Hook"]'));
  return readGuideData({ GUIDE_DATA_DIR: join(fixtures, 'generated'), GUIDE_SEAMS_DIR: seams, GUIDE_CONTENT_DIR: join(fixtures, 'content') });
}

describe('which pages exist', () => {
  test('a WordPress symbol has a WordPress page; a method is an anchor on its class page', () => {
    expect(pageOf('function:add_filter', 'wordpress', d)).toBe('/wordpress/hooks/add_filter/');
    expect(pageOf('method:WP_Hook::apply_filters', 'wordpress', d)).toBe('/wordpress/hooks/class/WP_Hook/#apply_filters');
    expect(pageOf('function:unassigned_thing', 'wordpress', d)).toBeNull();
  });

  test('a SpeedySpec page exists only when there is something SpeedySpec-specific to say', () => {
    expect(pageOf('function:add_filter', 'speedyspec', d)).toBe('/speedyspec/hooks/add_filter/');
    expect(pageOf('function:get_option', 'speedyspec', d)).toBe('/speedyspec/options/get_option/');
    expect(pageOf('global:wp_filter', 'speedyspec', d)).toBeNull();
    expect(pageOf('method:WP_Hook::apply_filters', 'speedyspec', d)).toBeNull();
  });

  test('links to pages that do not exist are not links', () => {
    const v = seamView('hooks', 'speedyspec', d);
    const wpFilter = v.roles.flatMap((r) => r.members).find((m) => m.id === 'global:wp_filter');
    expect(wpFilter?.href).toBeNull();
    expect(symbolView('function:add_filter', 'speedyspec', d).edges.find((e) => e.to.id === 'global:wp_filter')?.to.href).toBeNull();
  });

  test('page paths and links agree', () => {
    for (const p of wordpressPaths(d)) expect(pageOf(p.id, 'wordpress', d)).toBe(`/wordpress/${p.seam}/${p.slug}/`);
    for (const p of speedyspecPaths(d)) expect(pageOf(p.id, 'speedyspec', d)).toBe(`/speedyspec/${p.seam}/${p.slug}/`);
  });
});

describe('runtime symbols a seam lists', () => {
  test('belong to the SpeedySpec section only', async () => {
    const r = await withRuntimeListed();
    const id = 'class:SpeedySpec\\Hooks\\Hook';
    expect(seamView('hooks', 'wordpress', r).roles.flatMap((x) => x.members).some((m) => m.id === id)).toBe(false);
    expect(seamView('hooks', 'speedyspec', r).roles.flatMap((x) => x.members).some((m) => m.id === id)).toBe(true);
    expect(wordpressPaths(r).some((p) => p.id === id)).toBe(false);
    expect(speedyspecPaths(r).some((p) => p.id === id)).toBe(true);
    expect(r.assignment.seamOf[id]).toBeUndefined();
  });
});

describe('build cost', () => {
  test('a class with 200 methods in a seam of 600 members builds its view quickly', () => {
    const big = structuredClone(d);
    for (let i = 0; i < 600; i++) {
      const id = `function:f${i}`;
      big.inventory.symbols.push({ id, kind: 'function', name: `f${i}`, file: 'wp-includes/plugin.php', line: i, signature: `f${i}()` });
      big.assignment.seamOf[id] = 'hooks';
      if (i > 0) big.graph.edges.push({ from: `function:f${i - 1}`, to: id, kind: 'calls' });
    }
    for (let i = 0; i < 200; i++) {
      const id = `method:WP_Hook::m${i}`;
      big.inventory.symbols.push({ id, kind: 'method', name: `m${i}`, file: 'wp-includes/class-wp-hook.php', line: i, signature: `public m${i}()` });
      big.assignment.seamOf[id] = 'hooks';
    }
    const started = performance.now();
    const view = symbolView('class:WP_Hook', 'wordpress', big);
    expect(view.methods).toHaveLength(202);
    expect(performance.now() - started).toBeLessThan(1500);
  });
});
