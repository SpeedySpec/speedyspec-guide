import type { Assignment, Inventory, Seam } from '@speedyspec-guide/domain';

/**
 * Assigns every symbol to one seam: an explicit listing first, then the seam whose files hold it, then a method's
 * class, then a hook's firing seam or a global's writing (else reading) seam. A hook or global used from several
 * seams must be listed explicitly.
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
  const byUse = (kind: string) => isHook(kind) || kind === 'global';

  for (const sym of pending) {
    if (sym.kind === 'method' || byUse(sym.kind)) continue;
    place(sym.id, byFile(sym.file, sym.id));
  }
  for (const sym of pending) {
    if (sym.kind !== 'method') continue;
    const cls = `class:${sym.id.slice('method:'.length).split('::')[0]}`;
    const owner = seamOf[cls];
    if (owner && !seams.find((s) => s.id === owner)?.exclude.includes(sym.id)) seamOf[sym.id] = owner;
  }

  // Hooks go to the seam that fires them; globals to the seam that writes them, or reads them when nothing does.
  const seamsOf = (from: string): string[] => (from.startsWith('file:') ? byFile(from.slice('file:'.length)) : seamOf[from] ? [seamOf[from]!] : []);
  const users = (kind: 'fires' | 'writes' | 'reads') => {
    const out = new Map<string, Set<string>>();
    for (const e of inv.edges) {
      if (e.kind !== kind) continue;
      const set = out.get(e.to) ?? new Set<string>();
      for (const s of seamsOf(e.from)) set.add(s);
      out.set(e.to, set);
    }
    return out;
  };
  const firers = users('fires');
  const writers = users('writes');
  const readers = users('reads');
  for (const sym of pending) {
    if (isHook(sym.kind)) place(sym.id, [...(firers.get(sym.id) ?? [])]);
    else if (sym.kind === 'global') place(sym.id, [...(writers.get(sym.id)?.size ? writers.get(sym.id)! : readers.get(sym.id) ?? [])]);
  }

  const unassigned = inv.symbols.map((s) => s.id).filter((id) => seamOf[id] === undefined && !conflicts.some((c) => c.symbol === id));
  return { seamOf, unassigned: [...new Set(unassigned)], conflicts };

  function place(id: string, owners: string[]): void {
    const unique = [...new Set(owners)].sort();
    if (unique.length === 1) seamOf[id] = unique[0]!;
    else if (unique.length > 1) conflicts.push({ symbol: id, seams: unique });
  }
}
