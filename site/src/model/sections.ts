/** What the section index and seam pages list, and which symbol pages exist. */
import type { Citation } from '@speedyspec-guide/domain';
import type { GuideData } from './data.ts';
import { indexOf } from './index-of.ts';
import { type SpeedySpecVerdict, speedyspecVerdict } from './verdict.ts';
import { type MemberView, pageOf, seamView } from './views.ts';

/** Every WordPress symbol with its own page in a seam: everything assigned to it except methods. */
export function pageSymbols(seamId: string, d: GuideData): string[] {
  return indexOf(d).pageIds('wordpress').filter((id) => indexOf(d).seamOf(id) === seamId);
}

/** The WordPress pages to build. */
export function wordpressPaths(d: GuideData): { seam: string; slug: string; id: string }[] {
  return paths('wordpress', d);
}

function paths(section: 'wordpress' | 'speedyspec', d: GuideData): { seam: string; slug: string; id: string }[] {
  const ix = indexOf(d);
  const out = ix.pageIds(section).map((id) => ({ seam: ix.seamOf(id)!, slug: ix.slug(id), id }));
  // The paths actually used must differ ignoring case (macOS and Windows file systems ignore it).
  const seen = new Map<string, string>();
  for (const p of out) {
    const key = `${p.seam}/${p.slug}`.toLowerCase();
    const other = seen.get(key);
    if (other !== undefined) throw new Error(`${other} and ${p.id} would both be at ${key}`);
    seen.set(key, p.id);
  }
  return out;
}

/** How many of a seam's page symbols have a hand-written page in a section. */
export function documented(seamId: string, section: 'wordpress' | 'speedyspec', d: GuideData): { documented: number; total: number } {
  const ids = pageSymbols(seamId, d);
  const written = new Set(d.content.filter((c) => c.section === section && c.kind === 'symbol').map((c) => c.symbol));
  return { documented: ids.filter((id) => written.has(id)).length, total: ids.length };
}

/** The SpeedySpec pages to build: symbols with a SpeedySpec page, symbols the fork modified or removed, and runtime
 * symbols a seam lists. */
export function speedyspecPaths(d: GuideData): { seam: string; slug: string; id: string }[] {
  return paths('speedyspec', d);
}

const STATE_LABELS = { php: "calls WordPress's PHP", port: 'behind a port', rust: 'answered in Rust' } as const;

export interface DependencyRow {
  /** The symbol depended on. */
  target: string;
  /** How many edges reach it. */
  calls: number;
  /** The symbols on the other side, sorted. */
  from: string[];
  kinds: string[];
  state: string;
  /** The evidence for the state, when one is recorded. */
  cite?: Citation;
  circular: boolean;
}

/**
 * A seam's cross-seam dependencies, grouped by the other seam, one row per symbol depended on: what it depends on
 * (target in the other seam), and what depends on it (target in this seam, `from` in the other).
 */
export function dependencies(seamId: string, d: GuideData): { dependsOn: Map<string, DependencyRow[]>; dependedOnBy: Map<string, DependencyRow[]> } {
  const ix = indexOf(d);
  const key = `dependencies|${seamId}`;
  const hit = ix.memo.get(key) as ReturnType<typeof dependencies> | undefined;
  if (hit) return hit;
  const result = computeDependencies(seamId, d);
  ix.memo.set(key, result);
  return result;
}

function computeDependencies(seamId: string, d: GuideData): { dependsOn: Map<string, DependencyRow[]>; dependedOnBy: Map<string, DependencyRow[]> } {
  const ix = indexOf(d);
  const name = (id: string) => d.seams.find((s) => s.id === id)?.name ?? id;
  const together = (a: string, b: string) => ix.component(a)?.has(b) === true;
  const recorded = (owner: string, target: string) => d.seams.find((x) => x.id === owner)?.dependencies?.[target];
  const collect = (outgoing: boolean) => {
    const rows = new Map<string, Map<string, DependencyRow & { fromSet: Set<string>; kindSet: Set<string> }>>();
    for (const e of d.graph.crossSeam) {
      if ((outgoing ? e.fromSeam : e.toSeam) !== seamId) continue;
      const group = name(outgoing ? e.toSeam : e.fromSeam);
      const byTarget = rows.get(group) ?? new Map();
      rows.set(group, byTarget);
      const rec = recorded(e.fromSeam, e.to);
      const row = byTarget.get(e.to) ?? { target: e.to, calls: 0, from: [], kinds: [], state: rec ? STATE_LABELS[rec.state] : 'not yet recorded', ...(rec ? { cite: rec.cite } : {}), circular: false, fromSet: new Set<string>(), kindSet: new Set<string>() };
      row.calls++;
      row.fromSet.add(e.from);
      row.kindSet.add(e.kind);
      row.circular ||= together(e.from, e.to);
      byTarget.set(e.to, row);
    }
    const out = new Map<string, DependencyRow[]>();
    for (const [group, byTarget] of [...rows].sort((a, b) => a[0].localeCompare(b[0]))) {
      out.set(
        group,
        [...byTarget.values()]
          .map(({ fromSet, kindSet, ...row }) => ({ ...row, from: [...fromSet].sort(), kinds: [...kindSet].sort() }))
          .sort((a, b) => (a.target < b.target ? -1 : 1)),
      );
    }
    return out;
  };
  return { dependsOn: collect(true), dependedOnBy: collect(false) };
}

/** The `n` rows depended on most (by edge count), then by name: what a seam page shows before linking the full list. */
export function topRows(rows: DependencyRow[], n: number): DependencyRow[] {
  return [...rows].sort((a, b) => b.calls - a.calls || (a.target < b.target ? -1 : a.target > b.target ? 1 : 0)).slice(0, n);
}

/**
 * A shortest cycle through each member of the seam that is in a circular group, found in the dependency graph (the
 * group's stored sample path may never touch this seam). Direct links are preferred; a cycle that only closes through
 * a hook-name pattern is marked possible. A member already on a listed cycle gets no second one.
 */
export function seamCycles(seamId: string, d: GuideData): { path: string[]; possible: boolean }[] {
  const members = Object.entries(d.assignment.seamOf).filter(([, s]) => s === seamId).map(([id]) => id).sort();
  const groupOf = new Map<string, Set<string>>();
  for (const c of d.cycles.components) {
    const set = new Set(c);
    for (const id of c) groupOf.set(id, set);
  }
  const next = new Map<string, { to: string; pattern: boolean }[]>();
  for (const e of d.graph.edges) {
    if (e.broad) continue;
    next.set(e.from, [...(next.get(e.from) ?? []), { to: e.to, pattern: e.kind === 'matches' }]);
  }
  const out: { path: string[]; possible: boolean }[] = [];
  const covered = new Set<string>();
  for (const start of members) {
    const group = groupOf.get(start);
    if (!group || covered.has(start)) continue;
    const found = shortest(start, group, next, false) ?? shortest(start, group, next, true);
    if (!found) continue;
    out.push(found);
    for (const id of found.path) covered.add(id);
  }
  return out;
}

function shortest(start: string, group: Set<string>, next: Map<string, { to: string; pattern: boolean }[]>, allowPattern: boolean) {
  const prev = new Map<string, string>();
  const queue = [start];
  const seen = new Set([start]);
  while (queue.length > 0) {
    const node = queue.shift()!;
    for (const { to, pattern } of [...(next.get(node) ?? [])].sort((x, y) => x.to.localeCompare(y.to))) {
      if (!group.has(to) || (pattern && !allowPattern)) continue;
      if (to === start) {
        const path: string[] = [];
        for (let n = node; n !== start; n = prev.get(n)!) path.unshift(n);
        return { path: [start, ...path, start], possible: allowPattern };
      }
      if (!seen.has(to)) {
        seen.add(to);
        prev.set(to, node);
        queue.push(to);
      }
    }
  }
  return null;
}

/** A SpeedySpec seam page's compatibility rows, by role. */
export function compatGroups(seamId: string, d: GuideData): { role: string; rows: { member: MemberView; verdict: SpeedySpecVerdict; note?: string; href: string | null }[] }[] {
  const view = seamView(seamId, 'speedyspec', d);
  return view.roles.map((r) => ({
    role: r.role,
    rows: r.members.map((m) => {
      const v = speedyspecVerdict(m.id, d);
      return { member: m, verdict: v.verdict, ...(v.differences[0] ? { note: v.differences[0].summary } : {}), href: m.href ?? pageOf(m.id, 'wordpress', d) };
    }),
  }));
}

/** An other seam's id from the name its dependency group is listed under. */
export function seamIdByName(name: string, d: GuideData): string {
  return d.seams.find((s) => s.name === name)?.id ?? name;
}

/** What the runtime registers in PHP that WordPress doesn't have and no seam lists (methods go with their class). */
export function unplacedRuntime(d: GuideData): GuideData['runtime'] {
  const wordpress = new Set(d.inventory.symbols.map((s) => s.id));
  return d.runtime.filter((s) => !wordpress.has(s.id) && d.assignment.seamOf[s.id] === undefined && d.runtimeSeamOf[s.id] === undefined);
}
