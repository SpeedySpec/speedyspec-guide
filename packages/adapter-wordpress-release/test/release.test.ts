import { afterEach, beforeEach, describe, expect, test } from 'bun:test';
import { existsSync, mkdirSync, mkdtempSync, readdirSync, readFileSync, rmSync, writeFileSync } from 'node:fs';
import { tmpdir } from 'node:os';
import { join } from 'node:path';
import { WordPressRelease } from '../src/index.ts';

let work: string;
let tarball: Uint8Array;
let sha: string;

beforeEach(() => {
  work = mkdtempSync(join(tmpdir(), 'wp-release-'));
  const src = join(work, 'src');
  mkdirSync(join(src, 'wordpress', 'wp-includes'), { recursive: true });
  writeFileSync(join(src, 'wordpress', 'wp-includes', 'plugin.php'), '<?php function add_filter() {}\n');
  Bun.spawnSync(['tar', '-czf', join(work, 'wp.tar.gz'), '-C', src, 'wordpress']);
  tarball = new Uint8Array(readFileSync(join(work, 'wp.tar.gz')));
  sha = new Bun.CryptoHasher('sha256').update(tarball).digest('hex');
});
afterEach(() => rmSync(work, { recursive: true, force: true }));

function serving(): { impl: typeof fetch; calls: () => number } {
  let n = 0;
  const impl = (async () => {
    n++;
    return new Response(tarball);
  }) as unknown as typeof fetch;
  return { impl, calls: () => n };
}

describe('WordPressRelease', () => {
  test('downloads, verifies and extracts the release', async () => {
    const s = serving();
    const dir = await new WordPressRelease({ url: 'https://example.test/wp.tar.gz', sha256: sha }, join(work, 'cache'), s.impl).fetch('7.1.5');
    expect(dir).toBe(join(work, 'cache', 'wordpress-7.1.5', 'wordpress'));
    expect(existsSync(join(dir, 'wp-includes', 'plugin.php'))).toBe(true);
  });

  test('a second fetch uses the cache', async () => {
    const s = serving();
    const release = new WordPressRelease({ url: 'https://example.test/wp.tar.gz', sha256: sha }, join(work, 'cache'), s.impl);
    await release.fetch('7.1.5');
    await release.fetch('7.1.5');
    expect(s.calls()).toBe(1);
  });

  test('a checksum mismatch is refused and leaves nothing behind', async () => {
    const s = serving();
    const cache = join(work, 'cache');
    const release = new WordPressRelease({ url: 'https://example.test/wp.tar.gz', sha256: '0'.repeat(64) }, cache, s.impl);
    await expect(release.fetch('7.1.5')).rejects.toThrow('sha256 mismatch');
    expect(existsSync(cache) ? readdirSync(cache) : []).toEqual([]);
  });
});
