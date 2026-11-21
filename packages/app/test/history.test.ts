import { afterAll, describe, expect, test } from 'bun:test';
import { mkdtempSync, rmSync } from 'node:fs';
import { tmpdir } from 'node:os';
import { join } from 'node:path';
import type { SymbolSource } from '@speedyspec-guide/contracts';
import { GitTagHistory } from '../../adapter-git-tag-history/src/index.ts';
import { PhpParserSource } from '../../adapter-php-parser-source/src/index.ts';
import { makeRepo } from '../../../tests/fixtures/git/make-repo.ts';
import { computeHistory } from '../src/history.ts';

const repo = makeRepo();
const cache = mkdtempSync(join(tmpdir(), 'history-cache-'));
afterAll(() => {
  repo.cleanup();
  rmSync(cache, { recursive: true, force: true });
});

describe('computeHistory', () => {
  test('since is the first tag with a symbol, removed the first later tag without it', async () => {
    const h = await computeHistory(new GitTagHistory(repo.url, cache), new PhpParserSource(), { tags: [], symbols: {} });
    expect(h.tags).toEqual(['1.0', '3.7.0', '3.7.1']);
    expect(h.symbols['function:a']).toEqual({ since: '1.0', removed: '3.7.1' });
    expect(h.symbols['function:b']).toEqual({ since: '3.7.0' });
  });

  test('tags already in the cache are not parsed again', async () => {
    const real = new PhpParserSource();
    const first = await computeHistory(new GitTagHistory(repo.url, cache), real, { tags: [], symbols: {} });
    let calls = 0;
    const spy: SymbolSource = { extract: (...args) => { calls++; return real.extract(...args); } };
    const again = await computeHistory(new GitTagHistory(repo.url, cache), spy, first);
    expect(calls).toBe(0);
    expect(again).toEqual(first);
  });
});

describe('a tag with files that do not parse', () => {
  test('records the errors and marks nothing removed in that tag', async () => {
    const { makeBrokenRepo } = await import('../../../tests/fixtures/git/make-repo.ts');
    const broken = makeBrokenRepo();
    const dir = mkdtempSync(join(tmpdir(), 'history-broken-'));
    const h = await computeHistory(new GitTagHistory(broken.url, dir), new PhpParserSource(), { tags: [], symbols: {} });
    broken.cleanup();
    rmSync(dir, { recursive: true, force: true });
    expect(h.symbols['function:a']).toEqual({ since: '1.0' });
    expect(h.errors?.['1.1']).toEqual([expect.stringContaining('a.php')]);
  });
});

describe('progress', () => {
  test('the history is handed over after every tag, so a run that stops keeps what it parsed', async () => {
    const r = makeRepo();
    const dir = mkdtempSync(join(tmpdir(), 'history-progress-'));
    const seen: string[][] = [];
    await computeHistory(new GitTagHistory(r.url, dir), new PhpParserSource(), { tags: [], symbols: {} }, async (h) => {
      seen.push([...h.tags]);
    });
    r.cleanup();
    rmSync(dir, { recursive: true, force: true });
    expect(seen).toEqual([['1.0'], ['1.0', '3.7.0'], ['1.0', '3.7.0', '3.7.1']]);
  });
});
