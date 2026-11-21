import { describe, expect, test } from 'bun:test';
import type { GuideSymbol } from '@speedyspec-guide/domain';
import { updateRuntimeHistory } from '../src/runtime-history.ts';

const sym = (id: string): GuideSymbol => ({ id, kind: 'function', name: id, file: 'native', line: 0 });
const empty = { versions: [], symbols: {} };

describe('updateRuntimeHistory', () => {
  test('a symbol first seen before any release is unreleased', () => {
    expect(updateRuntimeHistory([sym('function:a')], '1.0.0', false, empty)).toEqual({ versions: [], symbols: { 'function:a': { since: 'unreleased' } } });
  });

  test('the first released run gives unreleased symbols that version', () => {
    const before = updateRuntimeHistory([sym('function:a')], '1.0.0', false, empty);
    expect(updateRuntimeHistory([sym('function:a')], '1.0.0', true, before)).toEqual({ versions: ['1.0.0'], symbols: { 'function:a': { since: '1.0.0' } } });
  });

  test('a symbol gone in a release is removed there', () => {
    const v1 = updateRuntimeHistory([sym('function:a'), sym('function:b')], '1.0.0', true, empty);
    const v2 = updateRuntimeHistory([sym('function:a')], '1.1.0', true, v1);
    expect(v2.symbols['function:b']).toEqual({ since: '1.0.0', removed: '1.1.0' });
    expect(v2.versions).toEqual(['1.0.0', '1.1.0']);
  });

  test('an unreleased run never marks anything removed', () => {
    const v1 = updateRuntimeHistory([sym('function:a'), sym('function:b')], '1.0.0', true, empty);
    expect(updateRuntimeHistory([sym('function:a')], '1.1.0', false, v1).symbols['function:b']).toEqual({ since: '1.0.0' });
  });

  test('running the same released version twice changes nothing', () => {
    const v1 = updateRuntimeHistory([sym('function:a')], '1.0.0', true, empty);
    expect(updateRuntimeHistory([sym('function:a')], '1.0.0', true, v1)).toEqual(v1);
  });
});
