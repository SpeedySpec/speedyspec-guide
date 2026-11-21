import type { ReleaseSource } from '@speedyspec-guide/contracts';
import { existsSync, mkdirSync, mkdtempSync, renameSync, rmSync } from 'node:fs';
import { join } from 'node:path';

type Spawn = (cmd: string[], opts?: Parameters<typeof Bun.spawnSync>[1]) => ReturnType<typeof Bun.spawnSync>;

/**
 * WordPress at a pinned commit of its repository: one folder of the commit (`src/`), exported with `git archive`
 * from a local git directory and kept in a cache. Only git objects are read: no checkout's working tree or branch is
 * touched. A commit the git directory lacks is fetched into it from the repository.
 */
export class WordPressCommit implements ReleaseSource {
  constructor(
    private readonly pin: { repo: string; commit: string; path: string },
    private readonly cacheDir: string,
    private readonly gitDir: string,
    private readonly spawn: Spawn = (cmd, opts) => Bun.spawnSync(cmd, opts),
  ) {}

  async fetch(_version: string): Promise<string> {
    const target = join(this.cacheDir, `wordpress-${this.pin.commit.slice(0, 12)}`);
    if (existsSync(target)) return target;

    const git = (...args: string[]) => this.spawn(['git', '--git-dir', this.gitDir, ...args], { stdout: 'pipe', stderr: 'pipe' });
    const has = () => git('cat-file', '-e', `${this.pin.commit}^{commit}`).exitCode === 0;
    if (!has()) {
      if (!existsSync(this.gitDir)) this.spawn(['git', 'init', '-q', '--bare', this.gitDir]);
      git('fetch', '-q', '--no-tags', this.pin.repo, this.pin.commit);
      if (!has()) {
        throw new Error(`WordPress commit ${this.pin.commit} is not in ${this.gitDir} and could not be fetched from ${this.pin.repo}; set GUIDE_WORDPRESS_GIT to a clone that has it`);
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
