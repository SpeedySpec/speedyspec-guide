import { existsSync, mkdirSync, renameSync, rmSync } from 'node:fs';
import { join } from 'node:path';

function git(args: string[], cwd?: string): string {
  const p = Bun.spawnSync(['git', ...args], { cwd, stdout: 'pipe', stderr: 'pipe' });
  if (p.exitCode !== 0) throw new Error(`git ${args.join(' ')}: ${p.stderr.toString().trim()}`);
  return p.stdout.toString().trim();
}

/**
 * A checkout of `repo` at `commit` in `<cache>/<name>-<commit>`. It is made in a temporary folder and moved into place
 * only once the commit is checked out, and a folder found at another commit is made again, so a failed run never
 * leaves a broken checkout behind.
 */
export function checkout(cache: string, name: string, repo: string, commit: string): string {
  const dir = join(cache, `${name}-${commit.slice(0, 12)}`);
  if (existsSync(dir)) {
    try {
      if (git(['rev-parse', 'HEAD'], dir) === commit) return dir;
    } catch {
      // Not a usable checkout; made again below.
    }
    rmSync(dir, { recursive: true, force: true });
  }
  mkdirSync(cache, { recursive: true });
  const temp = `${dir}.partial-${process.pid}`;
  rmSync(temp, { recursive: true, force: true });
  try {
    git(['clone', '--quiet', '--filter=blob:none', '--no-checkout', repo, temp]);
    git(['checkout', '--quiet', commit], temp);
    renameSync(temp, dir);
  } catch (e) {
    rmSync(temp, { recursive: true, force: true });
    throw e;
  }
  return dir;
}
