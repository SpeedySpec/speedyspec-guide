import { describe, expect, test } from 'bun:test';
import type { GuideSymbol, Inventory, Seam } from '@speedyspec-guide/domain';
import { withoutElsewhere } from '../src/elsewhere.ts';

const s = (id: string, file: string): GuideSymbol => ({ id, kind: id.split(':')[0] as GuideSymbol['kind'], name: id, file, line: 1 });
const seam = (over: Partial<Seam>): Seam => ({ id: 'p', name: 'P', job: '', ported: false, files: [], symbols: [], exclude: [], roles: {}, edges: [], wordpress: [], elsewhere: [], ...over });

describe('withoutElsewhere', () => {
  test('symbols_in_files_documented_elsewhere_leave_the_inventory', () => {
    const inv: Inventory = {
      base: 'wp',
      version: '7.1.5',
      symbols: [s('function:kept', 'a.php'), s('function:sodium_add', 'vendor/sodium/lib.php'), s('method:Sodium::f', 'vendor/sodium/C.php')],
      edges: [
        { from: 'function:kept', to: 'function:sodium_add', kind: 'calls' },
        { from: 'function:sodium_add', to: 'function:kept', kind: 'calls' },
        { from: 'file:a.php', to: 'function:kept', kind: 'calls' },
      ],
      unresolved: [],
    };
    const seams = [seam({ elsewhere: [{ name: 'Sodium', docs: 'https://www.php.net/manual/en/book.sodium.php', files: ['vendor/sodium/**'], note: '' }] })];
    const out = withoutElsewhere(inv, seams);
    expect(out.symbols.map((x) => x.id)).toEqual(['function:kept']);
    expect(out.edges).toEqual([{ from: 'file:a.php', to: 'function:kept', kind: 'calls' }]);
  });

  test('without_elsewhere_entries_the_inventory_is_unchanged', () => {
    const inv: Inventory = { base: 'wp', version: '7.1.5', symbols: [s('function:kept', 'a.php')], edges: [], unresolved: [] };
    expect(withoutElsewhere(inv, [seam({})])).toEqual(inv);
  });
});
