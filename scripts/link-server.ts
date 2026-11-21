/**
 * Makes `runner/server`, the symlink the runner crate's path dependencies go through: to GUIDE_SERVER_DIR, or else to
 * the pinned checkout of speedyspec-server in .cache. GUIDE_PHP_BUILDROOT names an existing static PHP build to use
 * when the checkout has none (`scripts/build-php.sh` takes a long time); otherwise build it there first.
 */
import { existsSync, lstatSync, mkdirSync, rmSync, symlinkSync } from 'node:fs';
import { join, resolve } from 'node:path';
import { checkout } from '../packages/cli/src/checkout.ts';

const root = resolve(import.meta.dir, '..');
const sources = await Bun.file(join(root, 'sources.json')).json();
const server = process.env.GUIDE_SERVER_DIR
  ? resolve(process.env.GUIDE_SERVER_DIR)
  : checkout(join(root, '.cache'), 'speedyspec-server', sources.server.repo, sources.server.commit);

const buildroot = join(server, '.php-build', 'buildroot');
if (!existsSync(join(buildroot, 'bin', 'php-config')) && process.env.GUIDE_PHP_BUILDROOT) {
  mkdirSync(join(server, '.php-build'), { recursive: true });
  rmSync(buildroot, { recursive: true, force: true });
  symlinkSync(resolve(process.env.GUIDE_PHP_BUILDROOT), buildroot);
}
if (!existsSync(join(buildroot, 'bin', 'php-config'))) {
  console.error(`${server} has no static PHP build: run scripts/build-php.sh there, or set GUIDE_PHP_BUILDROOT.`);
  process.exit(1);
}

const link = join(root, 'runner', 'server');
if (lstatSync(link, { throwIfNoEntry: false })) rmSync(link, { force: true });
symlinkSync(server, link);
console.log(`runner/server -> ${server}`);
