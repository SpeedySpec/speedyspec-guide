import type { ReleaseSource } from '@speedyspec-guide/contracts';
import { existsSync, mkdirSync, mkdtempSync, renameSync, rmSync, writeFileSync } from 'node:fs';
import { join } from 'node:path';

/** Downloads a pinned WordPress release, verifies its sha256 and keeps it extracted in a cache. */
export class WordPressRelease implements ReleaseSource {
  constructor(
    private readonly pinned: { url: string; sha256: string },
    private readonly cacheDir: string,
    private readonly fetchImpl: typeof fetch = fetch,
  ) {}

  async fetch(version: string): Promise<string> {
    const target = join(this.cacheDir, `wordpress-${version}`);
    const root = join(target, 'wordpress');
    if (existsSync(root)) return root;

    const response = await this.fetchImpl(this.pinned.url);
    if (!response.ok) throw new Error(`downloading ${this.pinned.url}: HTTP ${response.status}`);
    const bytes = new Uint8Array(await response.arrayBuffer());
    const actual = new Bun.CryptoHasher('sha256').update(bytes).digest('hex');
    if (actual !== this.pinned.sha256) {
      throw new Error(`sha256 mismatch for ${this.pinned.url}: expected ${this.pinned.sha256}, got ${actual}`);
    }

    mkdirSync(this.cacheDir, { recursive: true });
    const temp = mkdtempSync(join(this.cacheDir, '.download-'));
    try {
      const archive = join(temp, 'release.tar.gz');
      writeFileSync(archive, bytes);
      const out = join(temp, 'out');
      mkdirSync(out);
      const tar = Bun.spawnSync(['tar', '-xzf', archive, '-C', out]);
      if (tar.exitCode !== 0) throw new Error(`extracting ${this.pinned.url}: ${tar.stderr.toString()}`);
      if (!existsSync(join(out, 'wordpress'))) throw new Error(`${this.pinned.url} has no wordpress/ folder`);
      renameSync(out, target);
    } finally {
      rmSync(temp, { recursive: true, force: true });
    }
    return root;
  }
}
