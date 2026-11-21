import type { Assignment, Citation, Edge, EdgeKind, Inventory } from '@speedyspec-guide/domain';
import { hookPattern } from './hook-pattern.ts';

export interface CrossSeamEdge {
  from: string;
  to: string;
  fromSeam: string;
  toSeam: string;
  kind: EdgeKind;
  at?: Citation;
}

export interface Graph {
  nodes: string[];
  edges: Edge[];
  crossSeam: CrossSeamEdge[];
}

const DEPENDENCY: EdgeKind[] = ['calls', 'reads', 'writes', 'fires', 'runs'];

/**
 * The dependency graph: the inventory's edges, plus a `matches` edge from each dynamic hook to the literal hooks it
 * can be, plus each `runs` edge copied to the same-named hook of the other kind (WordPress keeps filters and actions in
 * one store, so `do_action( 'x' )` runs a callback added with `add_filter( 'x', … )`).
 */
export function buildGraph(inv: Inventory, a: Assignment): Graph {
  const edges: Edge[] = [...inv.edges];
  const ids = new Set(inv.symbols.map((s) => s.id));

  const hooks = inv.symbols.filter((s) => s.kind === 'filter' || s.kind === 'action');
  const literals = hooks.filter((h) => !h.dynamic);
  for (const dyn of hooks.filter((h) => h.dynamic)) {
    // A name with no literal text but separators (`{$hook_name}`, `{$taxonomy}_{$field}`) names no hook in
    // particular: its links are kept but marked broad, so they never make a cycle.
    const broad = dyn.name.replace(/\{\$[^}]*\}/g, '').replace(/[_\-./]/g, '') === '';
    const re = hookPattern(dyn.name);
    for (const lit of literals) {
      if (lit.kind !== dyn.kind || !re.test(lit.name)) continue;
      edges.push(broad ? { from: dyn.id, to: lit.id, kind: 'matches', broad: true } : { from: dyn.id, to: lit.id, kind: 'matches' });
    }
  }

  for (const edge of inv.edges) {
    if (edge.kind !== 'runs') continue;
    const [kind, ...rest] = edge.from.split(':');
    const twin = `${kind === 'filter' ? 'action' : 'filter'}:${rest.join(':')}`;
    if (ids.has(twin)) edges.push({ from: twin, to: edge.to, kind: 'runs' });
  }

  const nodes = new Set<string>(ids);
  for (const edge of edges) {
    nodes.add(edge.from);
    nodes.add(edge.to);
  }

  const crossSeam: CrossSeamEdge[] = [];
  for (const edge of edges) {
    if (!DEPENDENCY.includes(edge.kind)) continue;
    const fromSeam = a.seamOf[edge.from];
    const toSeam = a.seamOf[edge.to];
    if (fromSeam && toSeam && fromSeam !== toSeam) {
      const x: CrossSeamEdge = { from: edge.from, to: edge.to, fromSeam, toSeam, kind: edge.kind };
      if (edge.at) x.at = edge.at;
      crossSeam.push(x);
    }
  }
  return { nodes: [...nodes].sort(), edges, crossSeam };
}
