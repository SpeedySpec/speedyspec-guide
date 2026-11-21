import type { Assignment, Edge, Inventory, Seam } from '@speedyspec-guide/domain';
import { loadPositions } from './load-order.ts';


/**
 * Assigns every symbol to one seam: an explicit listing first, then the seam whose files hold it, then the seam that
 * holds most of its file's symbols, then a method's class, then a hook's firing seam or a global's writing (else
 * reading) seam. A hook or global used from several seams goes to the seam whose use comes first in WordPress's load
 * order (`order`, from wp-settings.php), and within one file the earlier line.
 */
export function assign(inv: Inventory, seams: Seam[], order: string[] = []): Assignment {
  const seamOf: Record<string, string> = {};
  const conflicts: Assignment['conflicts'] = [];
  const claimed = new Set<string>();

  // Only WordPress's symbols: an id a seam lists that the inventory doesn't have is the runtime's (the site places it).
  const known = new Set(inv.symbols.map((s) => s.id));
  const explicit = new Map<string, string[]>();
  for (const seam of seams) for (const id of seam.symbols) if (known.has(id)) explicit.set(id, [...(explicit.get(id) ?? []), seam.id]);
  for (const [id, owners] of explicit) {
    claimed.add(id);
    if (owners.length === 1) seamOf[id] = owners[0]!;
    else conflicts.push({ symbol: id, seams: [...owners].sort() });
  }

  const globs = seams.map((seam) => ({ seam, globs: seam.files.map((f) => new Bun.Glob(f)) }));
  // A seam that names the file exactly beats one whose glob matches it.
  const isGlob = (pattern: string) => /[*?[{]/.test(pattern);
  const byFile = (file: string, id?: string): string[] => {
    const allowed = ({ seam }: (typeof globs)[number]) => !(id && seam.exclude.includes(id));
    const exact = seams.filter((seam) => seam.files.some((f) => !isGlob(f) && f === file) && !(id && seam.exclude.includes(id))).map((seam) => seam.id);
    if (exact.length > 0) return exact;
    return globs.filter((g) => allowed(g) && g.globs.some((x) => x.match(file))).map(({ seam }) => seam.id);
  };

  const pending = inv.symbols.filter((s) => !claimed.has(s.id));
  const isHook = (kind: string) => kind === 'filter' || kind === 'action';
  const byUse = (kind: string) => isHook(kind) || kind === 'global';

  for (const sym of pending) {
    if (sym.kind === 'method' || byUse(sym.kind)) continue;
    place(sym.id, byFile(sym.file, sym.id));
  }

  // A symbol no file pattern places goes to the seam that holds most of the
  // symbols defined in its file; a file whose symbols no rule placed places nothing.
  const fileSeam = (() => {
    const counts = new Map<string, Map<string, number>>();
    for (const sym of inv.symbols) {
      const seam = seamOf[sym.id];
      if (seam === undefined) continue;
      const c = counts.get(sym.file) ?? new Map<string, number>();
      c.set(seam, (c.get(seam) ?? 0) + 1);
      counts.set(sym.file, c);
    }
    const out = new Map<string, string>();
    for (const [file, c] of counts) out.set(file, [...c].sort((a, b) => b[1] - a[1] || (a[0] < b[0] ? -1 : 1))[0]![0]);
    return out;
  })();
  const byMajority = (sym: { id: string; file: string }): string[] => {
    const seam = fileSeam.get(sym.file);
    return seam !== undefined && !seams.find((s) => s.id === seam)?.exclude.includes(sym.id) ? [seam] : [];
  };
  for (const sym of pending) {
    if (sym.kind === 'method' || byUse(sym.kind) || seamOf[sym.id] !== undefined || conflicts.some((c) => c.symbol === sym.id)) continue;
    place(sym.id, byMajority(sym));
  }
  for (const sym of pending) {
    if (sym.kind !== 'method') continue;
    const cls = `class:${sym.id.slice('method:'.length).split('::')[0]}`;
    const owner = seamOf[cls];
    if (owner && !seams.find((s) => s.id === owner)?.exclude.includes(sym.id)) seamOf[sym.id] = owner;
  }

  // Hooks go to the seam that fires them; globals to the seam that writes them, or reads them when nothing does. When
  // several seams do, the earliest use in WordPress's load order wins, then the earlier line in that file.
  const fileOf = new Map(inv.symbols.map((s) => [s.id, s.file]));
  const siteOf = (e: Edge): { file: string; line: number } => {
    if (e.at && e.at.kind === 'source') return { file: e.at.file, line: e.at.from };
    if (e.from.startsWith('file:')) return { file: e.from.slice('file:'.length), line: 0 };
    return { file: fileOf.get(e.from) ?? '', line: 0 };
  };
  const positions = loadPositions(order, inv.edges.map((e) => siteOf(e).file));
  const seamsOf = (from: string): string[] => {
    if (!from.startsWith('file:')) return seamOf[from] ? [seamOf[from]!] : [];
    const file = from.slice('file:'.length);
    const globbed = byFile(file);
    if (globbed.length > 0) return globbed;
    const seam = fileSeam.get(file);
    return seam === undefined ? [] : [seam];
  };
  const users = (kind: 'fires' | 'writes' | 'reads') => {
    const out = new Map<string, { seam: string; pos: number; line: number }[]>();
    for (const e of inv.edges) {
      if (e.kind !== kind) continue;
      const site = siteOf(e);
      const list = out.get(e.to) ?? [];
      for (const seam of seamsOf(e.from)) list.push({ seam, pos: positions.get(site.file) ?? Number.MAX_SAFE_INTEGER, line: site.line });
      out.set(e.to, list);
    }
    return out;
  };
  const first = (list: { seam: string; pos: number; line: number }[] | undefined): string[] => {
    if (!list || list.length === 0) return [];
    const best = [...list].sort((a, b) => a.pos - b.pos || a.line - b.line || (a.seam < b.seam ? -1 : 1))[0]!;
    return [best.seam];
  };
  const firers = users('fires');
  const writers = users('writes');
  const readers = users('reads');
  for (const sym of pending) {
    let owners: string[] = [];
    if (isHook(sym.kind)) owners = first(firers.get(sym.id));
    else if (sym.kind === 'global') owners = first(writers.get(sym.id)?.length ? writers.get(sym.id) : readers.get(sym.id));
    else continue;
    if (owners.length === 0) owners = byFile(sym.file, sym.id);
    place(sym.id, owners.length > 0 ? owners : byMajority(sym));
  }

  const unassigned = inv.symbols.map((s) => s.id).filter((id) => seamOf[id] === undefined && !conflicts.some((c) => c.symbol === id));
  return { seamOf, unassigned: [...new Set(unassigned)], conflicts };

  function place(id: string, owners: string[]): void {
    const unique = [...new Set(owners)].sort();
    if (unique.length === 1) seamOf[id] = unique[0]!;
    else if (unique.length > 1) conflicts.push({ symbol: id, seams: unique });
  }
}
