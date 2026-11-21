import { afterAll, describe, expect, test } from 'bun:test';
import { existsSync, mkdtempSync, readdirSync, rmSync } from 'node:fs';
import { tmpdir } from 'node:os';
import { join } from 'node:path';
import { makeRepo } from '../../../tests/fixtures/git/make-repo.ts';
import { checkout } from '../src/checkout.ts';

const repo = makeRepo();
const head = (ref: string) => Bun.spawnSync(['git', '-C', repo.dir, 'rev-parse', ref]).stdout.toString().trim();
const cache = mkdtempSync(join(tmpdir(), 'checkout-cache-'));
afterAll(() => {
  repo.cleanup();
  rmSync(cache, { recursive: true, force: true });
});

describe('checkout', () => {
  test('a commit that cannot be checked out leaves nothing behind', () => {
    expect(() => checkout(cache, 'x', repo.url, 'f'.repeat(40))).toThrow();
    expect(readdirSync(cache)).toEqual([]);
  });

  test('checks out the commit', () => {
    const dir = checkout(cache, 'x', repo.url, head('3.7.0'));
    expect(existsSync(join(dir, 'src', 'b.php'))).toBe(true);
  });

  test('a folder left at another commit is repaired', () => {
    const commit = head('3.7.1');
    const dir = checkout(cache, 'y', repo.url, commit);
    Bun.spawnSync(['git', '-C', dir, 'checkout', '--quiet', head('1.0')]);
    expect(checkout(cache, 'y', repo.url, commit)).toBe(dir);
    expect(Bun.spawnSync(['git', '-C', dir, 'rev-parse', 'HEAD']).stdout.toString().trim()).toBe(commit);
  });
});
