import { mkdirSync, mkdtempSync, rmSync, writeFileSync } from 'node:fs';
import { tmpdir } from 'node:os';
import { dirname, join } from 'node:path';

/**
 * A git repository with four tags: 1.0 (old root layout, a.php defines a()), 3.7.0 (src/ with a() and b()),
 * 3.7.1 (src/b.php only) and the pre-release 3.8-beta1.
 */
export function makeRepo(): { dir: string; url: string; cleanup: () => void } {
  const dir = mkdtempSync(join(tmpdir(), 'tags-repo-'));
  const git = (...args: string[]) => {
    const p = Bun.spawnSync(['git', '-c', 'user.name=t', '-c', 'user.email=t@example.test', '-c', 'commit.gpgsign=false', '-c', 'tag.gpgsign=false', ...args], { cwd: dir });
    if (p.exitCode !== 0) throw new Error(p.stderr.toString());
  };
  const write = (path: string, code: string) => {
    mkdirSync(dirname(join(dir, path)), { recursive: true });
    writeFileSync(join(dir, path), code);
  };
  const snapshot = (tag: string) => {
    git('add', '-A');
    git('commit', '-qm', tag, '--allow-empty');
    git('tag', tag);
  };
  git('init', '-q', '-b', 'trunk');
  write('a.php', '<?php function a() {}\n');
  snapshot('1.0');
  rmSync(join(dir, 'a.php'));
  write('src/a.php', '<?php function a() {}\n');
  write('src/b.php', '<?php function b() {}\n');
  snapshot('3.7.0');
  rmSync(join(dir, 'src', 'a.php'));
  snapshot('3.7.1');
  write('src/c.php', '<?php function c() {}\n');
  snapshot('3.8-beta1');
  return { dir, url: `file://${dir}`, cleanup: () => rmSync(dir, { recursive: true, force: true }) };
}

/** Tags 1.0 (a.php defines a()) and 1.1 (a.php no longer parses), then 1.2 (a.php fixed). */
export function makeBrokenRepo(): { url: string; cleanup: () => void } {
  const dir = mkdtempSync(join(tmpdir(), 'tags-broken-'));
  const git = (...args: string[]) => {
    const p = Bun.spawnSync(['git', '-c', 'user.name=t', '-c', 'user.email=t@example.test', '-c', 'commit.gpgsign=false', '-c', 'tag.gpgsign=false', ...args], { cwd: dir });
    if (p.exitCode !== 0) throw new Error(p.stderr.toString());
  };
  const snapshot = (tag: string, code: string) => {
    writeFileSync(join(dir, 'a.php'), code);
    git('add', '-A');
    git('commit', '-qm', tag);
    git('tag', tag);
  };
  git('init', '-q', '-b', 'trunk');
  snapshot('1.0', '<?php function a() {}\n');
  snapshot('1.1', '<?php function a( {\n');
  snapshot('1.2', '<?php function a() {}\n');
  return { url: `file://${dir}`, cleanup: () => rmSync(dir, { recursive: true, force: true }) };
}

/** A repository tagged speedyspec-php-runtime-v1.0.0 and speedyspec-server-v0.1.0. */
export function makeServerRepo(): { url: string; cleanup: () => void } {
  const dir = mkdtempSync(join(tmpdir(), 'tags-server-'));
  const git = (...args: string[]) => {
    const p = Bun.spawnSync(['git', '-c', 'user.name=t', '-c', 'user.email=t@example.test', '-c', 'commit.gpgsign=false', '-c', 'tag.gpgsign=false', ...args], { cwd: dir });
    if (p.exitCode !== 0) throw new Error(p.stderr.toString());
  };
  git('init', '-q', '-b', 'main');
  writeFileSync(join(dir, 'README.md'), 'x\n');
  git('add', '-A');
  git('commit', '-qm', 'x');
  git('tag', 'speedyspec-php-runtime-v1.0.0');
  git('tag', 'speedyspec-server-v0.1.0');
  return { url: `file://${dir}`, cleanup: () => rmSync(dir, { recursive: true, force: true }) };
}

/**
 * A WordPress-shaped repository: commit A has src/wp-includes/plugin.php saying "a", commit B (HEAD, trunk) says "b".
 * Its working tree is checked out at B.
 */
export function makeWordPressRepo(): { dir: string; url: string; a: string; b: string; cleanup: () => void } {
  const dir = mkdtempSync(join(tmpdir(), 'wp-repo-'));
  const git = (...args: string[]): string => {
    const p = Bun.spawnSync(['git', '-c', 'user.name=t', '-c', 'user.email=t@example.test', '-c', 'commit.gpgsign=false', ...args], { cwd: dir });
    if (p.exitCode !== 0) throw new Error(p.stderr.toString());
    return p.stdout.toString().trim();
  };
  const write = (path: string, code: string) => {
    mkdirSync(dirname(join(dir, path)), { recursive: true });
    writeFileSync(join(dir, path), code);
  };
  git('init', '-q', '-b', 'trunk');
  write('src/wp-includes/plugin.php', '<?php // a\n');
  write('README.md', 'not exported\n');
  git('add', '-A');
  git('commit', '-qm', 'a');
  const a = git('rev-parse', 'HEAD');
  write('src/wp-includes/plugin.php', '<?php // b\n');
  git('add', '-A');
  git('commit', '-qm', 'b');
  const b = git('rev-parse', 'HEAD');
  return { dir, url: `file://${dir}`, a, b, cleanup: () => rmSync(dir, { recursive: true, force: true }) };
}
