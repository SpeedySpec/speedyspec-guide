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
