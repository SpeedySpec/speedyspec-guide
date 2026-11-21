import type { Assignment, Edge, Inventory, Seam } from '@speedyspec-guide/domain';
import { loadPositions } from './load-order.ts';

const NO_FORK: Inventory = { base: 'ss', version: '', symbols: [], edges: [], unresolved: [] };

/**
 * Assigns every symbol to one seam: an explicit listing first, then the seam whose files hold it, then the seam that
 * owns the fork package SpeedySpec keeps it in, then a method's class, then a hook's firing seam or a global's writing
 * (else reading) seam. A hook or global used from several seams goes to the seam whose use comes first in WordPress's
 * load order (`order`, from wp-settings.php), and within one file the earlier line.
 */
export function assign(inv: Inventory, seams: Seam[], fork: Inventory = NO_FORK, order: string[] = []): Assignment {
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
  const byFile = (file: string, id?: string): string[] =>
    globs.filter(({ seam, globs }) => globs.some((g) => g.match(file)) && !(id && seam.exclude.includes(id))).map(({ seam }) => seam.id);

  const forkFile = new Map(fork.symbols.map((s) => [s.id, s.file]));
  const byPackage = (id: string): string[] => {
    const file = forkFile.get(id);
    if (file === undefined) return [];
    const pkg = file.split('/')[0]!;
    return seams.filter((seam) => seam.forkPackages?.includes(pkg) && !seam.exclude.includes(id)).map((seam) => seam.id);
  };

  const pending = inv.symbols.filter((s) => !claimed.has(s.id));
  const isHook = (kind: string) => kind === 'filter' || kind === 'action';
  const byUse = (kind: string) => isHook(kind) || kind === 'global';

  for (const sym of pending) {
    if (sym.kind === 'method' || byUse(sym.kind)) continue;
    const files = byFile(sym.file, sym.id);
    place(sym.id, files.length > 0 ? files : byPackage(sym.id));
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
  const seamsOf = (from: string): string[] => (from.startsWith('file:') ? byFile(from.slice('file:'.length)) : seamOf[from] ? [seamOf[from]!] : []);
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
    if (isHook(sym.kind)) place(sym.id, first(firers.get(sym.id)));
    else if (sym.kind === 'global') place(sym.id, first(writers.get(sym.id)?.length ? writers.get(sym.id) : readers.get(sym.id)));
  }

  const unassigned = inv.symbols.map((s) => s.id).filter((id) => seamOf[id] === undefined && !conflicts.some((c) => c.symbol === id));
  return { seamOf, unassigned: [...new Set(unassigned)], conflicts };

  function place(id: string, owners: string[]): void {
    const unique = [...new Set(owners)].sort();
    if (unique.length === 1) seamOf[id] = unique[0]!;
    else if (unique.length > 1) conflicts.push({ symbol: id, seams: unique });
  }
}
