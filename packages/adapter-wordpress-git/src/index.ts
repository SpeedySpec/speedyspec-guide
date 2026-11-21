import type { ReleaseSource } from '@speedyspec-guide/contracts';
import { existsSync, mkdirSync, mkdtempSync, renameSync, rmSync } from 'node:fs';
import { join } from 'node:path';

type Spawn = (cmd: string[], opts?: Parameters<typeof Bun.spawnSync>[1]) => ReturnType<typeof Bun.spawnSync>;

/**
 * WordPress at a pinned commit of its repository: one folder of the commit (`src/`), exported with `git archive`
 * from a local git directory and kept in a cache. Only git objects are read: no checkout's working tree or branch is
 * touched. `gitDir` may be a bare repository or a clone's root (its `.git` is used).
 *
 * With `fetch`, the adapter owns `gitDir`: it creates it (with the repository as `origin`) and fetches a missing
 * commit into it. Without it, `gitDir` is someone else's clone and is never written: a missing commit is an error.
 */
export class WordPressCommit implements ReleaseSource {
  constructor(
    private readonly pin: { repo: string; commit: string; path: string },
    private readonly cacheDir: string,
    private readonly gitDir: string,
    private readonly spawn: Spawn = (cmd, opts) => Bun.spawnSync(cmd, opts),
    private readonly options: { fetch: boolean } = { fetch: false },
  ) {}

  async fetch(_version: string): Promise<string> {
    const target = join(this.cacheDir, `wordpress-${this.pin.commit.slice(0, 12)}`);
    if (existsSync(target)) return target;

    const dir = existsSync(join(this.gitDir, '.git')) ? join(this.gitDir, '.git') : this.gitDir;
    const git = (...args: string[]) => this.spawn(['git', '--git-dir', dir, ...args], { stdout: 'pipe', stderr: 'pipe' });
    const has = () => git('cat-file', '-e', `${this.pin.commit}^{commit}`).exitCode === 0;
    if (!has()) {
      const missing = `WordPress commit ${this.pin.commit} is not in ${dir}`;
      if (!this.options.fetch) throw new Error(`${missing}; fetch it there yourself, or unset GUIDE_WORDPRESS_GIT so the guide fetches it into its own cache`);
      if (!existsSync(dir)) this.spawn(['git', 'init', '-q', '--bare', dir]);
      if (git('remote', 'get-url', 'origin').exitCode !== 0) git('remote', 'add', 'origin', this.pin.repo);
      const fetched = git('fetch', '-q', '--no-tags', '--depth=1', 'origin', this.pin.commit);
      if (!has()) {
        throw new Error(`${missing} and could not be fetched from ${this.pin.repo} (${fetched.stderr?.toString().trim() || `exit ${fetched.exitCode}`}); set GUIDE_WORDPRESS_GIT to a clone that has it`);
      }
    }

    mkdirSync(this.cacheDir, { recursive: true });
    const temp = mkdtempSync(join(this.cacheDir, '.export-'));
    try {
      const archive = git('archive', '--format=tar', this.pin.commit, this.pin.path);
      if (archive.exitCode !== 0) throw new Error(`git archive ${this.pin.commit} ${this.pin.path}: ${archive.stderr?.toString()}`);
      const out = join(temp, 'out');
      mkdirSync(out);
      const depth = this.pin.path.split('/').filter(Boolean).length;
      const tar = this.spawn(['tar', '-x', `--strip-components=${depth}`, '-C', out], { stdin: archive.stdout as Uint8Array, stderr: 'pipe' });
      if (tar.exitCode !== 0) throw new Error(`extracting ${this.pin.commit}: ${tar.stderr?.toString()}`);
      renameSync(out, target);
    } finally {
      rmSync(temp, { recursive: true, force: true });
    }
    return target;
  }
}
