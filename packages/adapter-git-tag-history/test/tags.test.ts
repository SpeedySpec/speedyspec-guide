import { afterAll, describe, expect, test } from 'bun:test';
import { existsSync, mkdtempSync, rmSync } from 'node:fs';
import { tmpdir } from 'node:os';
import { join } from 'node:path';
import { makeRepo } from '../../../tests/fixtures/git/make-repo.ts';
import { GitTagHistory } from '../src/index.ts';

const repo = makeRepo();
const cache = mkdtempSync(join(tmpdir(), 'tags-cache-'));
afterAll(() => {
  repo.cleanup();
  rmSync(cache, { recursive: true, force: true });
});

describe('GitTagHistory', () => {
  test('lists release tags in version order, without pre-releases', async () => {
    expect(await new GitTagHistory(repo.url, cache).tags()).toEqual(['1.0', '3.7.0', '3.7.1']);
  });

  test('checks out src/ when the tag has one', async () => {
    const dir = await new GitTagHistory(repo.url, cache).checkout('3.7.0');
    expect(existsSync(join(dir, 'a.php'))).toBe(true);
    expect(existsSync(join(dir, 'b.php'))).toBe(true);
  });

  test('checks out the root for the old layout', async () => {
    const dir = await new GitTagHistory(repo.url, cache).checkout('1.0');
    expect(existsSync(join(dir, 'a.php'))).toBe(true);
  });
});

describe('the clone', () => {
  test('is a full clone, so archiving a tag never fetches blobs one by one', async () => {
    await new GitTagHistory(repo.url, cache).checkout('3.7.0');
    const filter = Bun.spawnSync(['git', '-C', join(cache, 'repository.git'), 'config', '--get', 'remote.origin.partialclonefilter']);
    expect(filter.stdout.toString().trim()).toBe('');
  });
});
