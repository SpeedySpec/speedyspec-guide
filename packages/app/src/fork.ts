import type { ForkVerdict, Inventory } from '@speedyspec-guide/domain';

const COMPARED = new Set(['function', 'class', 'method']);

/** Compares SpeedySpec's `packages/` fork with WordPress, symbol by symbol, by code hash. */
export function compareFork(wp: Inventory, ss: Inventory): Record<string, ForkVerdict> {
  const ours = new Map(ss.symbols.filter((s) => COMPARED.has(s.kind)).map((s) => [s.id, s]));
  const out: Record<string, ForkVerdict> = {};
  for (const theirs of wp.symbols) {
    if (!COMPARED.has(theirs.kind)) continue;
    const mine = ours.get(theirs.id);
    out[theirs.id] = mine === undefined ? 'removed' : mine.hash === theirs.hash ? 'same' : 'modified';
    ours.delete(theirs.id);
  }
  for (const id of ours.keys()) out[id] = 'added';
  return out;
}
