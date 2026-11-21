import { describe, expect, test } from 'bun:test';
import { parseCitation } from '../src/index.ts';

describe('parseCitation', () => {
  test('a WordPress source range', () => {
    expect(parseCitation({ source: 'wp:wp-includes/plugin.php#L120-L134' })).toEqual({
      kind: 'source', base: 'wp', file: 'wp-includes/plugin.php', from: 120, to: 134,
    });
  });
  test('a single line', () => {
    expect(parseCitation({ source: 'ss:a/b.php#L7' })).toEqual({ kind: 'source', base: 'ss', file: 'a/b.php', from: 7, to: 7 });
  });
  test('a stored hash is kept', () => {
    expect(parseCitation({ source: 'wp:a.php#L1', hash: 'abc' })).toMatchObject({ hash: 'abc' });
  });
  test('a scenario defaults to the hooks area', () => {
    expect(parseCitation({ scenario: 'add_filter_returns_true' })).toEqual({ kind: 'scenario', area: 'hooks', name: 'add_filter_returns_true' });
  });
  test('a break with a step', () => {
    expect(parseCitation({ break: 'wp_filters_read_and_write', step: '5', area: 'hooks' })).toEqual({
      kind: 'break', area: 'hooks', scenario: 'wp_filters_read_and_write', step: 5,
    });
  });
  test('a test path', () => {
    expect(parseCitation({ test: 'speedyspec-wp-hooks-php::wordpress::replays' })).toEqual({ kind: 'test', path: 'speedyspec-wp-hooks-php::wordpress::replays' });
  });
  test('an unknown source base is rejected', () => {
    expect(() => parseCitation({ source: 'xx:a.php#L1' })).toThrow();
  });
  test('a source without lines is rejected', () => {
    expect(() => parseCitation({ source: 'wp:a.php' })).toThrow();
  });
});
