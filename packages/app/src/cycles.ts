import type { Assignment } from '@speedyspec-guide/domain';
import type { Graph } from './graph.ts';

export interface Cycles {
  /** Closed paths of symbols, first node repeated last. */
  symbol: string[][];
  /** Closed paths of seams. */
  seam: string[][];
}

/** Finds circular dependencies between symbols (through calls and hooks) and between seams. */
export function findCycles(g: Graph, _a: Assignment): Cycles {
  const symbolAdj = adjacency(g.edges.map((e) => [e.from, e.to] as const));
  const seamAdj = adjacency(g.crossSeam.map((e) => [e.fromSeam, e.toSeam] as const));
  return { symbol: cyclesOf(symbolAdj), seam: cyclesOf(seamAdj) };
}

function adjacency(pairs: readonly (readonly [string, string])[]): Map<string, Set<string>> {
  const adj = new Map<string, Set<string>>();
  for (const [from, to] of pairs) {
    if (!adj.has(from)) adj.set(from, new Set());
    if (!adj.has(to)) adj.set(to, new Set());
    adj.get(from)!.add(to);
  }
  return adj;
}

/** One shortest cycle per strongly connected component, through the component's smallest node. */
function cyclesOf(adj: Map<string, Set<string>>): string[][] {
  const out: string[][] = [];
  for (const scc of tarjan(adj)) {
    const members = new Set(scc);
    const start = [...scc].sort()[0]!;
    if (scc.length === 1 && !adj.get(start)!.has(start)) continue;
    out.push(shortestCycle(adj, members, start));
  }
  return out.sort((x, y) => (x[0]! < y[0]! ? -1 : x[0]! > y[0]! ? 1 : 0));
}

function shortestCycle(adj: Map<string, Set<string>>, members: Set<string>, start: string): string[] {
  const prev = new Map<string, string>();
  const queue = [start];
  const seen = new Set<string>();
  while (queue.length > 0) {
    const node = queue.shift()!;
    for (const next of [...adj.get(node)!].sort()) {
      if (!members.has(next)) continue;
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
  throw new Error(`no cycle through ${start}`);
}

/** Tarjan's strongly connected components, iterative so deep call chains don't overflow the stack. */
function tarjan(adj: Map<string, Set<string>>): string[][] {
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
      work.push({ node, it: adj.get(node)!.values() });
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
