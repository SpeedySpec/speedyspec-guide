/**
 * URL slugs for symbol ids. Functions are bare names (`add_filter`); classes, hooks, globals and constants are prefixed
 * with their kind (`class/WP_Hook`, `filter/the_content`), so `class:WP_Scripts` and `function:wp_scripts` don't share a
 * path on a case-insensitive file system. A namespace's `\` becomes `.`. Methods live on their class page, as an anchor.
 */

const PREFIXED = new Set(['class', 'filter', 'action', 'global', 'constant']);

export function symbolSlug(id: string): string {
  const colon = id.indexOf(':');
  const kind = id.slice(0, colon);
  const name = id.slice(colon + 1);
  if (kind === 'method') {
    const { page, anchor } = methodAnchor(id);
    return `${page}#${anchor}`;
  }
  const slug = clean(name.replaceAll('\\', '.'));
  return PREFIXED.has(kind) ? `${kind}/${slug}` : slug;
}

/** A method's class page slug and its anchor there. */
export function methodAnchor(id: string): { page: string; anchor: string } {
  const name = id.slice('method:'.length);
  const at = name.lastIndexOf('::');
  return { page: symbolSlug(`class:${name.slice(0, at)}`), anchor: clean(name.slice(at + 2)) };
}

/** `{$var}` parts become `{var}` (anything but letters, digits and `_` inside them becomes `-`); every other
 * character outside `[A-Za-z0-9_.{}-]` becomes `-`. */
function clean(name: string): string {
  return name
    .replace(/\{\$?([^}]*)\}/g, (_, inner: string) => `{${inner.replace(/[^A-Za-z0-9_]+/g, '-').replace(/^-+|-+$/g, '')}}`)
    .replace(/[^A-Za-z0-9_.{}-]/g, '-');
}

/** The id among `ids` whose slug is `slug`. */
export function symbolFromSlug(slug: string, ids: Set<string>): string | undefined {
  for (const id of ids) if (symbolSlug(id) === slug) return id;
  return undefined;
}

/** Throws when two of the ids would share a page, ignoring case (macOS and Windows file systems do). */
export function assertUniqueSlugs(ids: string[]): void {
  const seen = new Map<string, string>();
  for (const id of [...ids].sort()) {
    const slug = symbolSlug(id).toLowerCase();
    const other = seen.get(slug);
    if (other !== undefined && other !== id) throw new Error(`${other} and ${id} would both be at ${slug}`);
    seen.set(slug, id);
  }
}

/**
 * Every id's slug, unique ignoring case: ids that would still collide (`global:post_ID` and `global:post_id`) are
 * taken in sorted order and the second and later get `~2`, `~3`… The same ids always give the same slugs.
 */
export function uniqueSlugs(ids: string[]): Map<string, string> {
  const out = new Map<string, string>();
  const taken = new Map<string, number>();
  for (const id of [...new Set(ids)].sort()) {
    const slug = symbolSlug(id);
    if (id.startsWith('method:')) {
      out.set(id, slug);
      continue;
    }
    const n = (taken.get(slug.toLowerCase()) ?? 0) + 1;
    taken.set(slug.toLowerCase(), n);
    out.set(id, n === 1 ? slug : `${slug}~${n}`);
  }
  return out;
}
