import { describe, expect, test } from 'bun:test';
import type { Assignment, Edge, GuideSymbol, Inventory } from '@speedyspec-guide/domain';
import { findCycles } from '../src/cycles.ts';
import { buildGraph } from '../src/graph.ts';

const sym = (id: string): GuideSymbol => ({ id, kind: id.split(':')[0] as GuideSymbol['kind'], name: id, file: 'f.php', line: 1 });
const e = (from: string, to: string, kind: Edge['kind']): Edge => ({ from, to, kind });
function cycles(ids: string[], edges: Edge[], seamOf: Record<string, string> = {}) {
  const a: Assignment = { seamOf, unassigned: [], conflicts: [] };
  const inv: Inventory = { base: 'wp', version: '7.1.5', symbols: ids.map(sym), edges, unresolved: [] };
  return findCycles(buildGraph(inv, a), a);
}

describe('findCycles', () => {
  test('two functions calling each other', () => {
    expect(cycles(['function:f', 'function:g'], [e('function:f', 'function:g', 'calls'), e('function:g', 'function:f', 'calls')]).symbol)
      .toEqual([['function:f', 'function:g', 'function:f']]);
  });

  test('a cycle through a hook and its callback', () => {
    const r = cycles(['function:f', 'filter:x', 'function:g'], [e('function:f', 'filter:x', 'fires'), e('filter:x', 'function:g', 'runs'), e('function:g', 'function:f', 'calls')]);
    expect(r.symbol).toEqual([['filter:x', 'function:g', 'function:f', 'filter:x']]);
  });

  test('a callback that fires the hook it is on', () => {
    const r = cycles(['filter:x', 'function:h'], [e('filter:x', 'function:h', 'runs'), e('function:h', 'filter:x', 'fires')]);
    expect(r.symbol).toEqual([['filter:x', 'function:h', 'filter:x']]);
  });

  test('a function calling itself is a cycle of one', () => {
    expect(cycles(['function:r'], [e('function:r', 'function:r', 'calls')]).symbol).toEqual([['function:r', 'function:r']]);
  });

  test('seams that depend on each other', () => {
    const r = cycles(['function:a', 'function:b'], [e('function:a', 'function:b', 'calls'), e('function:b', 'function:a', 'calls')], { 'function:a': 'a', 'function:b': 'b' });
    expect(r.seam).toEqual([['a', 'b', 'a']]);
  });

  test('a graph without cycles has none', () => {
    const r = cycles(['function:a', 'function:b', 'function:c'], [e('function:a', 'function:b', 'calls'), e('function:b', 'function:c', 'calls')], { 'function:a': 'a', 'function:b': 'b', 'function:c': 'c' });
    expect(r).toEqual({ symbol: [], seam: [] });
  });

  test('reading and writing one global is not a cycle', () => {
    expect(cycles(['function:a', 'function:b', 'global:g'], [e('function:a', 'global:g', 'writes'), e('function:b', 'global:g', 'reads')]).symbol).toEqual([]);
  });
});
