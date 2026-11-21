import { describe, expect, test } from 'bun:test';
import type { Edge, GuideSymbol, Inventory, Seam } from '@speedyspec-guide/domain';
import { assign } from '../src/assign.ts';

const s = (id: string, file: string): GuideSymbol => ({ id, kind: id.split(':')[0] as GuideSymbol['kind'], name: id, file, line: 1 });
const fires = (from: string, to: string): Edge => ({ from, to, kind: 'fires' });
const seam = (id: string, over: Partial<Seam>): Seam => ({ id, name: id, job: '', ported: false, files: [], symbols: [], exclude: [], roles: {}, edges: [], wordpress: [], ...over });

const seams = [seam('a', { files: ['a/*.php'], exclude: ['function:excluded'] }), seam('b', { files: ['b/*.php'], symbols: ['function:shared'] })];

function inv(symbols: GuideSymbol[], edges: Edge[] = []): Inventory {
  return { base: 'wp', version: '7.1.5', symbols, edges, unresolved: [] };
}

describe('assign', () => {
  test('a symbol in a seam file belongs to that seam', () => {
    expect(assign(inv([s('function:x', 'a/x.php')]), seams).seamOf['function:x']).toBe('a');
  });
  test('an explicit listing beats the file', () => {
    expect(assign(inv([s('function:shared', 'a/x.php')]), seams).seamOf['function:shared']).toBe('b');
  });
  test('an excluded symbol is unassigned', () => {
    expect(assign(inv([s('function:excluded', 'a/x.php')]), seams).unassigned).toEqual(['function:excluded']);
  });
  test('a method follows its class', () => {
    const r = assign(inv([s('class:A', 'a/x.php'), s('method:A::m', 'elsewhere.php')]), seams);
    expect(r.seamOf['method:A::m']).toBe('a');
  });
  test('a hook fired only from one seam belongs there, including from top-level code', () => {
    const r = assign(inv([s('function:x', 'a/x.php'), s('filter:h', 'a/x.php'), s('action:t', 'b/y.php')], [fires('function:x', 'filter:h'), fires('file:b/y.php', 'action:t')]), seams);
    expect(r.seamOf['filter:h']).toBe('a');
    expect(r.seamOf['action:t']).toBe('b');
  });
  test('a hook fired from two seams and listed nowhere is a conflict', () => {
    const r = assign(inv([s('function:x', 'a/x.php'), s('function:y', 'b/y.php'), s('filter:h', 'a/x.php')], [fires('function:x', 'filter:h'), fires('function:y', 'filter:h')]), seams);
    expect(r.conflicts).toEqual([{ symbol: 'filter:h', seams: ['a', 'b'] }]);
    expect(r.seamOf['filter:h']).toBeUndefined();
  });
  test('two seams listing one symbol is a conflict', () => {
    const r = assign(inv([s('function:z', 'c/z.php')]), [seam('a', { symbols: ['function:z'] }), seam('b', { symbols: ['function:z'] })]);
    expect(r.conflicts).toEqual([{ symbol: 'function:z', seams: ['a', 'b'] }]);
  });
  test('a symbol matching no seam is unassigned', () => {
    expect(assign(inv([s('function:lost', 'c/z.php')]), seams).unassigned).toEqual(['function:lost']);
  });
});

describe('globals', () => {
  const w = (from: string, to: string): Edge => ({ from, to, kind: 'writes' });
  const r = (from: string, to: string): Edge => ({ from, to, kind: 'reads' });

  test('a global belongs to the seam that writes it, not the file that names it first', () => {
    const res = assign(inv([s('function:x', 'a/x.php'), s('function:y', 'b/y.php'), s('global:g', 'a/x.php')], [r('function:x', 'global:g'), w('function:y', 'global:g')]), seams);
    expect(res.seamOf['global:g']).toBe('b');
  });

  test('a global only read belongs to the seam that reads it', () => {
    expect(assign(inv([s('function:y', 'b/y.php'), s('global:g', 'a/x.php')], [r('function:y', 'global:g')]), seams).seamOf['global:g']).toBe('b');
  });

  test('a global written from two seams and listed nowhere is a conflict', () => {
    const res = assign(inv([s('function:x', 'a/x.php'), s('function:y', 'b/y.php'), s('global:g', 'a/x.php')], [w('function:x', 'global:g'), w('function:y', 'global:g')]), seams);
    expect(res.conflicts).toEqual([{ symbol: 'global:g', seams: ['a', 'b'] }]);
  });
});

describe('symbols a seam lists that WordPress does not have', () => {
  test('are not part of the WordPress assignment (they are the runtime\'s, placed by the site)', () => {
    const r = assign(inv([s('function:x', 'a/x.php')]), [seam('a', { files: ['a/*.php'], symbols: ['class:SpeedySpec\\Only'] })]);
    expect(r.seamOf['class:SpeedySpec\\Only']).toBeUndefined();
    expect(r.seamOf['function:x']).toBe('a');
  });
});
