import { afterEach, describe, expect, test } from 'bun:test';
import { existsSync, mkdtempSync, readFileSync, rmSync, writeFileSync } from 'node:fs';
import { tmpdir } from 'node:os';
import { join } from 'node:path';
import { makeWordPressRepo } from '../../../tests/fixtures/git/make-repo.ts';
import { WordPressCommit } from '../src/index.ts';

const cleanups: (() => void)[] = [];
afterEach(() => {
  while (cleanups.length) cleanups.pop()!();
});
const temp = (prefix: string) => {
  const dir = mkdtempSync(join(tmpdir(), prefix));
  cleanups.push(() => rmSync(dir, { recursive: true, force: true }));
  return dir;
};
const git = (cwd: string, ...args: string[]) => Bun.spawnSync(['git', ...args], { cwd }).stdout.toString();

describe('WordPressCommit', () => {
  test('exports_src_at_the_commit', async () => {
    const repo = makeWordPressRepo();
    cleanups.push(repo.cleanup);
    const out = await new WordPressCommit({ repo: repo.url, commit: repo.a, path: 'src' }, temp('cache-'), join(repo.dir, '.git')).fetch('7.2-RC1');
    expect(out.endsWith(`wordpress-${repo.a.slice(0, 12)}`)).toBe(true);
    expect(readFileSync(join(out, 'wp-includes', 'plugin.php'), 'utf8')).toBe('<?php // a\n');
    expect(existsSync(join(out, 'src'))).toBe(false);
    expect(existsSync(join(out, 'README.md'))).toBe(false);
  });

  test('exports_the_commit_not_the_working_tree', async () => {
    const repo = makeWordPressRepo();
    cleanups.push(repo.cleanup);
    writeFileSync(join(repo.dir, 'src', 'wp-includes', 'plugin.php'), '<?php // uncommitted\n');
    const before = [git(repo.dir, 'status', '--porcelain'), git(repo.dir, 'rev-parse', 'HEAD')];
    const out = await new WordPressCommit({ repo: repo.url, commit: repo.a, path: 'src' }, temp('cache-'), join(repo.dir, '.git')).fetch('x');
    expect(readFileSync(join(out, 'wp-includes', 'plugin.php'), 'utf8')).toBe('<?php // a\n');
    expect([git(repo.dir, 'status', '--porcelain'), git(repo.dir, 'rev-parse', 'HEAD')]).toEqual(before);
  });

  test('fetches_a_commit_the_git_dir_lacks', async () => {
    const repo = makeWordPressRepo();
    cleanups.push(repo.cleanup);
    // A bare repository with none of the commits.
    const bare = temp('bare-');
    Bun.spawnSync(['git', 'init', '-q', '--bare', bare]);
    const out = await new WordPressCommit({ repo: repo.url, commit: repo.b, path: 'src' }, temp('cache-'), bare, undefined, { fetch: true }).fetch('x');
    expect(readFileSync(join(out, 'wp-includes', 'plugin.php'), 'utf8')).toBe('<?php // b\n');
  });

  test('names_the_commit_when_it_cannot_be_found', async () => {
    const repo = makeWordPressRepo();
    cleanups.push(repo.cleanup);
    const missing = '0123456789abcdef0123456789abcdef01234567';
    await expect(new WordPressCommit({ repo: repo.url, commit: missing, path: 'src' }, temp('cache-'), join(repo.dir, '.git')).fetch('x')).rejects.toThrow(new RegExp(`${missing}.*GUIDE_WORDPRESS_GIT`, 's'));
  });

  test('reuses_the_export', async () => {
    const repo = makeWordPressRepo();
    cleanups.push(repo.cleanup);
    const cache = temp('cache-');
    let spawns = 0;
    const counting = (cmd: string[], opts?: Parameters<typeof Bun.spawnSync>[1]) => {
      spawns++;
      return Bun.spawnSync(cmd, opts);
    };
    const source = new WordPressCommit({ repo: repo.url, commit: repo.a, path: 'src' }, cache, join(repo.dir, '.git'), counting);
    const first = await source.fetch('x');
    const used = spawns;
    expect(await source.fetch('x')).toBe(first);
    expect(spawns).toBe(used);
  });
});

describe('who owns the git directory', () => {
  test('a_git_dir_it_creates_has_the_repository_as_origin', async () => {
    const repo = makeWordPressRepo();
    cleanups.push(repo.cleanup);
    const owned = join(temp('own-'), 'wordpress.git');
    await new WordPressCommit({ repo: repo.url, commit: repo.a, path: 'src' }, temp('cache-'), owned, undefined, { fetch: true }).fetch('x');
    expect(Bun.spawnSync(['git', '--git-dir', owned, 'remote', 'get-url', 'origin']).stdout.toString().trim()).toBe(repo.url);
  });

  test('accepts_a_clone_root_as_the_git_dir', async () => {
    const repo = makeWordPressRepo();
    cleanups.push(repo.cleanup);
    const out = await new WordPressCommit({ repo: repo.url, commit: repo.a, path: 'src' }, temp('cache-'), repo.dir, undefined, { fetch: false }).fetch('x');
    expect(readFileSync(join(out, 'wp-includes', 'plugin.php'), 'utf8')).toBe('<?php // a\n');
  });

  test('never_fetches_into_a_given_clone', async () => {
    const repo = makeWordPressRepo();
    cleanups.push(repo.cleanup);
    const given = temp('given-');
    Bun.spawnSync(['git', 'clone', '-q', repo.url, given]);
    // A commit the given clone doesn't have.
    Bun.spawnSync(['git', '-c', 'user.name=t', '-c', 'user.email=t@example.test', 'commit', '-q', '--allow-empty', '-m', 'c'], { cwd: repo.dir });
    const c = git(repo.dir, 'rev-parse', 'HEAD').trim();
    const objectsBefore = git(given, 'count-objects', '-v');
    await expect(new WordPressCommit({ repo: repo.url, commit: c, path: 'src' }, temp('cache-'), given, undefined, { fetch: false }).fetch('x')).rejects.toThrow(new RegExp(`${c}.*GUIDE_WORDPRESS_GIT`, 's'));
    expect(git(given, 'count-objects', '-v')).toBe(objectsBefore);
    expect(existsSync(join(given, '.git', 'FETCH_HEAD'))).toBe(false);
  });
});
