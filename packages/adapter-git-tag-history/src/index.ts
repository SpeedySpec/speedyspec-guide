import type { ReleaseHistory } from '@speedyspec-guide/contracts';
import { Version } from '@speedyspec-guide/domain';
import { existsSync, mkdirSync, rmSync } from 'node:fs';
import { join } from 'node:path';

/** Release tags of a git repository, read through one full bare clone kept in a cache and fetched once per run. */
export class GitTagHistory implements ReleaseHistory {
  private readonly clone: string;
  private fetched = false;

  constructor(private readonly remote: string, private readonly cacheDir: string) {
    this.clone = join(cacheDir, 'repository.git');
  }

  async tags(): Promise<string[]> {
    const out = run(['git', 'ls-remote', '--tags', '--refs', this.remote]);
    return out
      .split('\n')
      .map((line) => /refs\/tags\/(.+)$/.exec(line)?.[1])
      .filter((t): t is string => t !== undefined && Version.isRelease(t))
      .sort((a, b) => Version.parse(a).compare(Version.parse(b)));
  }

  async checkout(tag: string): Promise<string> {
    this.ensureClone();
    // One checkout at a time: the previous tag's files are removed before the next is written.
    rmSync(join(this.cacheDir, 'tags'), { recursive: true, force: true });
    const dir = join(this.cacheDir, 'tags', tag);
    mkdirSync(dir, { recursive: true });
    const archive = Bun.spawnSync(['git', '-C', this.clone, 'archive', '--format=tar', `refs/tags/${tag}`], { stdout: 'pipe' });
    if (archive.exitCode !== 0) throw new Error(`git archive ${tag}: ${archive.stderr.toString()}`);
    const tar = Bun.spawnSync(['tar', '-x', '-C', dir], { stdin: archive.stdout });
    if (tar.exitCode !== 0) throw new Error(`extracting ${tag}: ${tar.stderr.toString()}`);
    return existsSync(join(dir, 'src')) ? join(dir, 'src') : dir;
  }

  private ensureClone(): void {
    if (this.fetched) return;
    if (!existsSync(this.clone)) {
      mkdirSync(this.cacheDir, { recursive: true });
      run(['git', 'clone', '--quiet', '--bare', this.remote, this.clone]);
    } else {
      run(['git', '-C', this.clone, 'fetch', '--quiet', '--tags', '--force', 'origin']);
    }
    this.fetched = true;
  }
}

function run(cmd: string[]): string {
  const p = Bun.spawnSync(cmd, { stdout: 'pipe', stderr: 'pipe' });
  if (p.exitCode !== 0) throw new Error(`${cmd.join(' ')}: ${p.stderr.toString().trim()}`);
  return p.stdout.toString();
}
