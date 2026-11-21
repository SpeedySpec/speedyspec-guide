import type { Assignment, Inventory, Seam } from '@speedyspec-guide/domain';

/**
 * Assigns every symbol to one seam: an explicit listing first, then the seam whose files hold it, then a method's
 * class, then a hook's firing seam. A hook fired from several seams must be listed explicitly.
 */
export function assign(inv: Inventory, seams: Seam[]): Assignment {
  const seamOf: Record<string, string> = {};
  const conflicts: Assignment['conflicts'] = [];
  const claimed = new Set<string>();

  const explicit = new Map<string, string[]>();
  for (const seam of seams) for (const id of seam.symbols) explicit.set(id, [...(explicit.get(id) ?? []), seam.id]);
  for (const [id, owners] of explicit) {
    claimed.add(id);
    if (owners.length === 1) seamOf[id] = owners[0]!;
    else conflicts.push({ symbol: id, seams: [...owners].sort() });
  }

  const globs = seams.map((seam) => ({ seam, globs: seam.files.map((f) => new Bun.Glob(f)) }));
  const byFile = (file: string, id?: string): string[] =>
    globs.filter(({ seam, globs }) => globs.some((g) => g.match(file)) && !(id && seam.exclude.includes(id))).map(({ seam }) => seam.id);

  const pending = inv.symbols.filter((s) => !claimed.has(s.id));
  const isHook = (kind: string) => kind === 'filter' || kind === 'action';

  for (const sym of pending) {
    if (sym.kind === 'method' || isHook(sym.kind)) continue;
    place(sym.id, byFile(sym.file, sym.id));
  }
  for (const sym of pending) {
    if (sym.kind !== 'method') continue;
    const cls = `class:${sym.id.slice('method:'.length).split('::')[0]}`;
    const owner = seamOf[cls];
    if (owner && !seams.find((s) => s.id === owner)?.exclude.includes(sym.id)) seamOf[sym.id] = owner;
  }

  const firers = new Map<string, Set<string>>();
  for (const e of inv.edges) {
    if (e.kind !== 'fires') continue;
    const from = e.from.startsWith('file:') ? byFile(e.from.slice('file:'.length)) : seamOf[e.from] ? [seamOf[e.from]!] : [];
    const set = firers.get(e.to) ?? new Set<string>();
    for (const s of from) set.add(s);
    firers.set(e.to, set);
  }
  for (const sym of pending) {
    if (!isHook(sym.kind)) continue;
    place(sym.id, [...(firers.get(sym.id) ?? [])]);
  }

  const unassigned = inv.symbols.map((s) => s.id).filter((id) => seamOf[id] === undefined && !conflicts.some((c) => c.symbol === id));
  return { seamOf, unassigned: [...new Set(unassigned)], conflicts };

  function place(id: string, owners: string[]): void {
    const unique = [...new Set(owners)].sort();
    if (unique.length === 1) seamOf[id] = unique[0]!;
    else if (unique.length > 1) conflicts.push({ symbol: id, seams: unique });
  }
}
