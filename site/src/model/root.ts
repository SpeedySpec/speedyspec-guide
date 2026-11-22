/** Where the guide repository's root is, from wherever the build placed the asking module. */
import { existsSync } from 'node:fs';
import { dirname, join } from 'node:path';

/** The file only the guide repository's root holds. */
const MARKER = 'guide.config.json';

function above(start: string): string | null {
  for (let dir = start; ; dir = dirname(dir)) {
    if (existsSync(join(dir, MARKER))) return dir;
    if (dirname(dir) === dir) return null;
  }
}

/**
 * The guide repository's root: the nearest folder holding guide.config.json.
 *
 * A module's depth below the root changes once Astro bundles it (and between Astro versions), so walk up from the
 * module, then from the working directory, rather than counting folders.
 *
 * @param from
 *     Path of the module asking (sources or bundled chunk).
 * @param cwd
 *     Folder to try when nothing above `from` is the root.
 * @return
 *     Absolute path of the root.
 * @throws Error
 *     If neither `from` nor `cwd` is inside the guide repository.
 */
export function guideRoot(from: string, cwd: string = process.cwd()): string {
  const root = above(dirname(from)) ?? above(cwd);
  if (root === null) throw new Error(`no folder above ${from} or ${cwd} holds ${MARKER}`);
  return root;
}
