import type { Inventory, Seam } from '@speedyspec-guide/domain';

/**
 * The inventory without the symbols of APIs documented elsewhere (a seam's `elsewhere` files), nor the edges to or
 * from them: the guide links to that documentation instead of describing the API itself.
 */
export function withoutElsewhere(inv: Inventory, seams: Seam[]): Inventory {
  const globs = seams.flatMap((seam) => seam.elsewhere.flatMap((e) => e.files.map((f) => new Bun.Glob(f))));
  if (globs.length === 0) return inv;
  const dropped = new Set(inv.symbols.filter((s) => globs.some((g) => g.match(s.file))).map((s) => s.id));
  if (dropped.size === 0) return inv;
  return {
    ...inv,
    symbols: inv.symbols.filter((s) => !dropped.has(s.id)),
    edges: inv.edges.filter((e) => !dropped.has(e.from) && !dropped.has(e.to)),
  };
}
