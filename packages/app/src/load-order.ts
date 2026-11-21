/**
 * WordPress's load order, read from `wp-settings.php`: the files it requires, in order. Files it doesn't require come
 * after every required file, in path order, so any two files have distinct positions.
 */
const REQUIRE = /require(?:_once)?\s*\(?\s*ABSPATH\s*\.\s*(WPINC\s*\.\s*)?'([^']+)'/g;

export function loadOrder(settings: string): string[] {
  const out: string[] = [];
  for (const m of settings.matchAll(REQUIRE)) {
    const rel = m[1] ? `wp-includes/${m[2]!.replace(/^\//, '')}` : m[2]!.replace(/^\//, '');
    if (!out.includes(rel)) out.push(rel);
  }
  return out;
}

/** Every file's place: the required files in `order`, then the rest of `files` in path order. */
export function loadPositions(order: string[], files: Iterable<string>): Map<string, number> {
  const out = new Map<string, number>(order.map((f, i) => [f, i]));
  const rest = [...new Set(files)].filter((f) => !out.has(f)).sort((a, b) => (a < b ? -1 : a > b ? 1 : 0));
  rest.forEach((f, i) => out.set(f, order.length + i));
  return out;
}
