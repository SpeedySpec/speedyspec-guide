import type { Graph } from './graph.ts';

/** One closed path, first node repeated last. `possible` when it only closes through a hook-name pattern match. */
export interface CyclePath {
  path: string[];
  possible: boolean;
}

export interface Cycles {
  /** One shortest cycle per circular group of symbols. */
  symbol: CyclePath[];
  /** Closed paths of seams. */
  seam: string[][];
  /** Every circular group of symbols (a strongly connected component), so each member can be marked. */
  components: string[][];
}

type Adjacency = Map<string, Map<string, boolean>>; // node -> next -> whether the link is a pattern match

/** Finds circular dependencies between symbols (through calls and hooks) and between seams. */
export function findCycles(g: Graph): Cycles {
  const symbolAdj: Adjacency = new Map();
  for (const e of g.edges) if (!e.broad) link(symbolAdj, e.from, e.to, e.kind === 'matches');
  const seamAdj: Adjacency = new Map();
  for (const e of g.crossSeam) link(seamAdj, e.fromSeam, e.toSeam, false);

  const symbolGroups = circular(symbolAdj);
  return {
    symbol: symbolGroups.map((scc) => shortestCycle(symbolAdj, scc)).sort(byStart),
    seam: circular(seamAdj).map((scc) => shortestCycle(seamAdj, scc).path).sort((x, y) => cmp(x[0]!, y[0]!)),
    components: symbolGroups.map((scc) => [...scc].sort()).sort((x, y) => cmp(x[0]!, y[0]!)),
  };
}

function link(adj: Adjacency, from: string, to: string, pattern: boolean): void {
  if (!adj.has(from)) adj.set(from, new Map());
  if (!adj.has(to)) adj.set(to, new Map());
  const next = adj.get(from)!;
  next.set(to, (next.get(to) ?? true) && pattern);
}

const cmp = (a: string, b: string) => (a < b ? -1 : a > b ? 1 : 0);
const byStart = (x: CyclePath, y: CyclePath) => cmp(x.path[0]!, y.path[0]!);

/** Strongly connected components that hold a cycle: more than one node, or a node linking to itself. */
function circular(adj: Adjacency): string[][] {
  return tarjan(adj).filter((scc) => scc.length > 1 || adj.get(scc[0]!)!.has(scc[0]!));
}

/** The shortest cycle through the group's smallest node, using direct links only if it can, else pattern matches too. */
function shortestCycle(adj: Adjacency, scc: string[]): CyclePath {
  const members = new Set(scc);
  const start = [...scc].sort()[0]!;
  const direct = bfs(adj, members, start, false);
  if (direct) return { path: direct, possible: false };
  const any = bfs(adj, members, start, true);
  if (!any) throw new Error(`no cycle through ${start}`);
  return { path: any, possible: true };
}

function bfs(adj: Adjacency, members: Set<string>, start: string, allowPattern: boolean): string[] | null {
  const prev = new Map<string, string>();
  const seen = new Set<string>();
  const queue = [start];
  while (queue.length > 0) {
    const node = queue.shift()!;
    for (const [next, pattern] of [...adj.get(node)!].sort(([a], [b]) => cmp(a, b))) {
      if (!members.has(next) || (pattern && !allowPattern)) continue;
      if (next === start) {
        const path: string[] = [];
        for (let n = node; n !== start; n = prev.get(n)!) path.unshift(n);
        return [start, ...path, start];
      }
      if (!seen.has(next)) {
        seen.add(next);
        prev.set(next, node);
        queue.push(next);
      }
    }
  }
  return null;
}

/** Tarjan's strongly connected components, iterative so deep call chains don't overflow the stack. */
function tarjan(adj: Adjacency): string[][] {
  let index = 0;
  const idx = new Map<string, number>();
  const low = new Map<string, number>();
  const onStack = new Set<string>();
  const stack: string[] = [];
  const result: string[][] = [];

  for (const root of adj.keys()) {
    if (idx.has(root)) continue;
    const work: { node: string; it: Iterator<string> }[] = [];
    const visit = (node: string) => {
      idx.set(node, index);
      low.set(node, index);
      index++;
      stack.push(node);
      onStack.add(node);
      work.push({ node, it: adj.get(node)!.keys() });
    };
    visit(root);
    while (work.length > 0) {
      const frame = work[work.length - 1]!;
      const step = frame.it.next();
      if (!step.done) {
        const next = step.value;
        if (!idx.has(next)) visit(next);
        else if (onStack.has(next)) low.set(frame.node, Math.min(low.get(frame.node)!, idx.get(next)!));
        continue;
      }
      work.pop();
      const parent = work[work.length - 1];
      if (parent) low.set(parent.node, Math.min(low.get(parent.node)!, low.get(frame.node)!));
      if (low.get(frame.node) === idx.get(frame.node)) {
        const scc: string[] = [];
        let n: string;
        do {
          n = stack.pop()!;
          onStack.delete(n);
          scc.push(n);
        } while (n !== frame.node);
        result.push(scc);
      }
    }
  }
  return result;
}
