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

describe('a tag prefix', () => {
  test('keeps only the tags with the prefix, without it', async () => {
    const { makeServerRepo } = await import('../../../tests/fixtures/git/make-repo.ts');
    const server = makeServerRepo();
    const dir = mkdtempSync(join(tmpdir(), 'tags-prefix-'));
    const tags = await new GitTagHistory(server.url, dir, 'speedyspec-php-runtime-v').tags();
    server.cleanup();
    rmSync(dir, { recursive: true, force: true });
    expect(tags).toEqual(['1.0.0']);
  });
});

describe('tagCommit', () => {
  test('is the commit a tag points to, or null for no such tag', async () => {
    const { makeServerRepo } = await import('../../../tests/fixtures/git/make-repo.ts');
    const server = makeServerRepo();
    const dir = mkdtempSync(join(tmpdir(), 'tags-commit-'));
    const history = new GitTagHistory(server.url, dir, 'speedyspec-php-runtime-v');
    const head = Bun.spawnSync(['git', '-C', server.url.replace('file://', ''), 'rev-parse', 'HEAD']).stdout.toString().trim();
    expect(await history.tagCommit('1.0.0')).toBe(head);
    expect(await history.tagCommit('9.9.9')).toBeNull();
    server.cleanup();
    rmSync(dir, { recursive: true, force: true });
  });
});
