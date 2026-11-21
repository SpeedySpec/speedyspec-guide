import { describe, expect, test } from 'bun:test';
import type { Assignment, Edge, GuideSymbol, Inventory } from '@speedyspec-guide/domain';
import { buildGraph } from '../src/graph.ts';

const sym = (id: string, dynamic = false): GuideSymbol => ({ id, kind: id.split(':')[0] as GuideSymbol['kind'], name: id.split(':').slice(1).join(':'), file: 'f.php', line: 1, ...(dynamic ? { dynamic } : {}) });
const e = (from: string, to: string, kind: Edge['kind']): Edge => ({ from, to, kind });
const inv = (symbols: GuideSymbol[], edges: Edge[]): Inventory => ({ base: 'wp', version: '7.1.5', symbols, edges, unresolved: [] });
const asg = (seamOf: Record<string, string>): Assignment => ({ seamOf, unassigned: [], conflicts: [] });

describe('buildGraph', () => {
  test('a dynamic hook matches the literal hooks of its kind', () => {
    const g = buildGraph(inv([sym('filter:update_option_{$option}', true), sym('filter:update_option_blogname'), sym('action:update_option_blogname')], []), asg({}));
    expect(g.edges).toContainEqual({ from: 'filter:update_option_{$option}', to: 'filter:update_option_blogname', kind: 'matches' });
    expect(g.edges.some((x) => x.to === 'action:update_option_blogname')).toBe(false);
  });

  test('a callback added with add_action runs when the same-named filter fires', () => {
    const g = buildGraph(inv([sym('filter:x'), sym('action:x'), sym('function:cb')], [e('action:x', 'function:cb', 'runs')]), asg({}));
    expect(g.edges).toContainEqual({ from: 'filter:x', to: 'function:cb', kind: 'runs' });
  });

  test('edges between seams are listed with both seams', () => {
    const g = buildGraph(inv([sym('function:a'), sym('function:b')], [e('function:a', 'function:b', 'calls')]), asg({ 'function:a': 'options', 'function:b': 'multisite' }));
    expect(g.crossSeam).toEqual([{ from: 'function:a', to: 'function:b', fromSeam: 'options', toSeam: 'multisite', kind: 'calls' }]);
  });

  test('edges within a seam are not cross-seam', () => {
    const g = buildGraph(inv([sym('function:a'), sym('function:b')], [e('function:a', 'function:b', 'calls')]), asg({ 'function:a': 'x', 'function:b': 'x' }));
    expect(g.crossSeam).toEqual([]);
  });
});
