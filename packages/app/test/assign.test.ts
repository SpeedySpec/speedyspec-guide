import { describe, expect, test } from 'bun:test';
import type { Edge, GuideSymbol, Inventory, Seam } from '@speedyspec-guide/domain';
import { assign } from '../src/assign.ts';

const s = (id: string, file: string): GuideSymbol => ({ id, kind: id.split(':')[0] as GuideSymbol['kind'], name: id, file, line: 1 });
const fires = (from: string, to: string): Edge => ({ from, to, kind: 'fires' });
const at = (file: string, line: number) => ({ kind: 'source' as const, base: 'wp' as const, file, from: line, to: line });
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
  test('a hook fired from two seams goes to the first in load order, by its firer\'s file when the edge has no site', () => {
    const r = assign(inv([s('function:x', 'a/x.php'), s('function:y', 'b/y.php'), s('filter:h', 'a/x.php')], [fires('function:y', 'filter:h'), fires('function:x', 'filter:h')]), seams);
    expect(r.conflicts).toEqual([]);
    expect(r.seamOf['filter:h']).toBe('a');
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

  test('a global written from two seams goes to the first writer in path order when neither file is required', () => {
    const res = assign(inv([s('function:x', 'a/x.php'), s('function:y', 'b/y.php'), s('global:g', 'a/x.php')], [w('function:y', 'global:g'), w('function:x', 'global:g')]), seams);
    expect(res.conflicts).toEqual([]);
    expect(res.seamOf['global:g']).toBe('a');
  });
});

describe('symbols a seam lists that WordPress does not have', () => {
  test('are not part of the WordPress assignment (they are the runtime\'s, placed by the site)', () => {
    const r = assign(inv([s('function:x', 'a/x.php')]), [seam('a', { files: ['a/*.php'], symbols: ['class:SpeedySpec\\Only'] })]);
    expect(r.seamOf['class:SpeedySpec\\Only']).toBeUndefined();
    expect(r.seamOf['function:x']).toBe('a');
  });
});

describe('fork packages and load order', () => {
  const ss = (id: string, file: string): Inventory => ({ base: 'ss', version: 'x', symbols: [s(id, file)], edges: [], unresolved: [] });
  const none: Inventory = { base: 'ss', version: 'x', symbols: [], edges: [], unresolved: [] };

  test('fork_package_places_a_symbol', () => {
    const r = assign(inv([s('function:get_option', 'wp-includes/option.php')]), [seam('options', { forkPackages: ['wp-option'] })], ss('function:get_option', 'wp-option/wp-option-legacy/functions/option.php'), []);
    expect(r.seamOf['function:get_option']).toBe('options');
  });
  test('files_glob_wins_over_fork_package', () => {
    const r = assign(inv([s('function:f', 'a/f.php')]), [seam('a', { files: ['a/*.php'] }), seam('b', { forkPackages: ['wp-b'] })], ss('function:f', 'wp-b/f.php'), []);
    expect(r.seamOf['function:f']).toBe('a');
    expect(r.conflicts).toEqual([]);
  });
  test('fork_package_respects_exclude', () => {
    const r = assign(inv([s('function:f', 'x/f.php')]), [seam('b', { forkPackages: ['wp-b'], exclude: ['function:f'] })], ss('function:f', 'wp-b/f.php'), []);
    expect(r.unassigned).toEqual(['function:f']);
  });
  test('hook_fired_from_two_seams_goes_to_the_first_in_load_order', () => {
    const sm = [seam('A', { files: ['wp-includes/late.php'] }), seam('B', { files: ['wp-includes/early.php'] })];
    const r = assign(
      inv([s('function:a', 'wp-includes/late.php'), s('function:b', 'wp-includes/early.php'), s('filter:x', 'wp-includes/late.php')], [
        { ...fires('function:a', 'filter:x'), at: at('wp-includes/late.php', 3) },
        { ...fires('function:b', 'filter:x'), at: at('wp-includes/early.php', 900) },
      ]),
      sm,
      none,
      ['wp-includes/early.php', 'wp-includes/late.php'],
    );
    expect(r.seamOf['filter:x']).toBe('B');
    expect(r.conflicts).toEqual([]);
  });
  test('ties_in_one_file_go_to_the_earlier_line', () => {
    const sm = [seam('A', { symbols: ['function:a'] }), seam('B', { symbols: ['function:b'] })];
    const r = assign(
      inv([s('function:a', 'f.php'), s('function:b', 'f.php'), s('filter:x', 'f.php')], [
        { ...fires('function:b', 'filter:x'), at: at('f.php', 10) },
        { ...fires('function:a', 'filter:x'), at: at('f.php', 5) },
      ]),
      sm,
      none,
      [],
    );
    expect(r.seamOf['filter:x']).toBe('A');
  });
  test('global_written_by_two_seams_goes_to_the_first_writer_in_load_order', () => {
    const sm = [seam('A', { files: ['late.php'] }), seam('B', { files: ['early.php'] })];
    const w = (from: string, file: string): Edge => ({ from, to: 'global:g', kind: 'writes', at: at(file, 1) });
    const r = assign(
      inv([s('function:a', 'late.php'), s('function:b', 'early.php'), s('function:c', 'early.php'), s('global:g', 'late.php')], [w('function:a', 'late.php'), w('function:b', 'early.php'), { from: 'function:c', to: 'global:g', kind: 'reads', at: at('early.php', 1) }]),
      sm,
      none,
      ['early.php', 'late.php'],
    );
    expect(r.seamOf['global:g']).toBe('B');
  });
});
