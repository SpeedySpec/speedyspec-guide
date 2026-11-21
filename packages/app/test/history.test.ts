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
