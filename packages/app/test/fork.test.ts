import { describe, expect, test } from 'bun:test';
import type { GuideSymbol, Inventory } from '@speedyspec-guide/domain';
import { compareFork } from '../src/fork.ts';

const s = (id: string, hash?: string): GuideSymbol => ({ id, kind: id.split(':')[0] as GuideSymbol['kind'], name: id, file: 'f.php', line: 1, ...(hash ? { hash } : {}) });
const inv = (base: 'wp' | 'ss', symbols: GuideSymbol[]): Inventory => ({ base, version: 'x', symbols, edges: [], unresolved: [] });

describe('compareFork', () => {
  test('gives same, modified, removed and added, and skips globals, constants and hooks', () => {
    const wp = inv('wp', [s('function:same', 'h1'), s('function:changed', 'h2'), s('class:Gone', 'h3'), s('method:K::m', 'h4'), s('global:g'), s('constant:C'), s('filter:f')]);
    const ss = inv('ss', [s('function:same', 'h1'), s('function:changed', 'h9'), s('method:K::m', 'h4'), s('function:new', 'h5'), s('global:g')]);
    expect(compareFork(wp, ss)).toEqual({
      'function:same': 'same',
      'function:changed': 'modified',
      'class:Gone': 'removed',
      'method:K::m': 'same',
      'function:new': 'added',
    });
  });
});
