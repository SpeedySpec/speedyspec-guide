import { describe, expect, test } from 'bun:test';
import { cpSync, mkdtempSync, rmSync } from 'node:fs';
import { tmpdir } from 'node:os';
import { join } from 'node:path';
import { SeamFiles } from '../src/index.ts';

const fixtures = join(import.meta.dir, '..', '..', '..', 'tests', 'fixtures', 'seams');

function only(...names: string[]): string {
  const dir = mkdtempSync(join(tmpdir(), 'seams-'));
  for (const n of names) cpSync(join(fixtures, n), join(dir, n), { recursive: true });
  return dir;
}

describe('SeamFiles', () => {
  test('reads every seam, named by its folder, with defaults and parsed edges', async () => {
    const dir = only('a', 'b');
    const seams = await new SeamFiles(dir).all();
    rmSync(dir, { recursive: true });
    expect(seams.map((s) => s.id)).toEqual(['a', 'b']);
    expect(seams[0]).toMatchObject({ name: 'A', ported: false, files: ['a/*.php'], exclude: ['function:excluded'], roles: { main: ['function:in_a'] } });
    expect(seams[0]?.edges[0]).toEqual({ from: 'function:in_a', to: 'global:g', kind: 'writes', at: { kind: 'source', base: 'wp', file: 'a/x.php', from: 3, to: 3 } });
    expect(seams[1]).toMatchObject({ ported: true, symbols: ['function:shared'], exclude: [], roles: {}, edges: [], wordpress: [] });
  });

  test('reads forkPackages and inFork, which defaults to true', async () => {
    const dir = only('a', 'forked');
    const [a, forked] = await new SeamFiles(dir).all();
    rmSync(dir, { recursive: true });
    expect(a).toMatchObject({ forkPackages: [], inFork: true });
    expect(forked).toMatchObject({ forkPackages: ['wp-forked'], inFork: false });
  });

  test('a seam missing its job is refused, naming the file and field', async () => {
    const dir = only('broken');
    await expect(new SeamFiles(dir).all()).rejects.toThrow(/broken\/seam\.yaml.*job/);
    rmSync(dir, { recursive: true });
  });
});
