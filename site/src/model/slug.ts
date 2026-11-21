/**
 * URL slugs for symbol ids. Functions and classes are bare names (`add_filter`, `WP_Hook`); a namespace's `\` becomes
 * `.`; hooks, globals and constants are prefixed with their kind (`filter/the_content`). Methods live on their class
 * page, as an anchor.
 */

const PREFIXED = new Set(['filter', 'action', 'global', 'constant']);

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

/** Throws when two of the ids would share a page. */
export function assertUniqueSlugs(ids: string[]): void {
  const seen = new Map<string, string>();
  for (const id of ids) {
    const slug = symbolSlug(id);
    const other = seen.get(slug);
    if (other !== undefined && other !== id) throw new Error(`${other} and ${id} would both be at ${slug}`);
    seen.set(slug, id);
  }
}
