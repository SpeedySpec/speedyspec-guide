/** What the section index and seam pages list, and which symbol pages exist. */
import type { GuideData } from './data.ts';
import { assertUniqueSlugs, symbolSlug } from './slug.ts';

/** Every symbol with its own page in a seam: everything assigned to it except methods (they live on their class). */
export function pageSymbols(seamId: string, d: GuideData): string[] {
  return Object.entries(d.assignment.seamOf)
    .filter(([id, s]) => s === seamId && !id.startsWith('method:'))
    .map(([id]) => id)
    .sort();
}

/** The WordPress pages to build: one per page symbol of every seam, with unique slugs. */
export function wordpressPaths(d: GuideData): { seam: string; slug: string; id: string }[] {
  const out: { seam: string; slug: string; id: string }[] = [];
  for (const seam of d.seams) {
    const ids = pageSymbols(seam.id, d);
    assertUniqueSlugs(ids);
    for (const id of ids) out.push({ seam: seam.id, slug: symbolSlug(id), id });
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
  const out: { seam: string; slug: string; id: string }[] = [];
  const written = new Set(d.content.filter((c) => c.section === 'speedyspec' && c.kind === 'symbol').map((c) => c.symbol));
  const runtime = new Set(d.runtime.map((s) => s.id));
  const wordpress = new Set(d.inventory.symbols.map((s) => s.id));
  for (const seam of d.seams) {
    const ids = Object.entries(d.assignment.seamOf)
      .filter(([id, s]) => s === seam.id && !id.startsWith('method:'))
      .map(([id]) => id)
      .filter((id) => written.has(id) || d.fork[id] === 'modified' || d.fork[id] === 'removed' || (runtime.has(id) && !wordpress.has(id)))
      .sort();
    assertUniqueSlugs(ids);
    for (const id of ids) out.push({ seam: seam.id, slug: symbolSlug(id), id });
  }
  return out;
}

const STATE_LABELS = { php: "calls WordPress's PHP", port: 'behind a port', rust: 'answered in Rust' } as const;

export interface DependencyRow {
  from: string;
  to: string;
  kind: string;
  state: string;
  circular: boolean;
}

/** A seam's cross-seam dependencies, grouped by the other seam: what it depends on, and what depends on it. */
export function dependencies(seamId: string, d: GuideData): { dependsOn: Map<string, DependencyRow[]>; dependedOnBy: Map<string, DependencyRow[]> } {
  const name = (id: string) => d.seams.find((s) => s.id === id)?.name ?? id;
  const together = (a: string, b: string) => d.cycles.components.some((c) => c.includes(a) && c.includes(b));
  const state = (owner: string, target: string) => {
    const s = d.seams.find((x) => x.id === owner)?.dependencies?.[target];
    return s ? STATE_LABELS[s] : 'not yet recorded';
  };
  const dependsOn = new Map<string, DependencyRow[]>();
  const dependedOnBy = new Map<string, DependencyRow[]>();
  for (const e of d.graph.crossSeam) {
    const row = (owner: string): DependencyRow => ({ from: e.from, to: e.to, kind: e.kind, state: state(owner, e.to), circular: together(e.from, e.to) });
    if (e.fromSeam === seamId) dependsOn.set(name(e.toSeam), [...(dependsOn.get(name(e.toSeam)) ?? []), row(seamId)]);
    if (e.toSeam === seamId) dependedOnBy.set(name(e.fromSeam), [...(dependedOnBy.get(name(e.fromSeam)) ?? []), row(e.fromSeam)]);
  }
  return { dependsOn, dependedOnBy };
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
