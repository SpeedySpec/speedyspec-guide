import { describe, expect, test } from 'bun:test';
import { type KeyValueStore, markRead, progress, READ_KEY, readSet } from '../src/scripts/read-progress.ts';

/** A store kept in a plain object, like localStorage. */
function memory(initial?: string): KeyValueStore & { value: string | null } {
  const s = {
    value: initial ?? null,
    getItem: (k: string) => (k === READ_KEY ? s.value : null),
    setItem: (k: string, v: string) => {
      if (k === READ_KEY) s.value = v;
    },
  };
  return s;
}

const throwing: KeyValueStore = {
  getItem: () => {
    throw new Error('SecurityError');
  },
  setItem: () => {
    throw new Error('QuotaExceededError');
  },
};

describe('readSet and markRead', () => {
  test('test_empty_store_reads_as_empty', () => {
    expect(readSet(memory()).size).toBe(0);
  });

  test('test_mark_read_round_trips', () => {
    const s = memory();
    markRead(s, '/guides/path/a/');
    expect([...readSet(s)]).toEqual(['/guides/path/a/']);
    markRead(s, '/guides/path/a/');
    expect([...readSet(s)]).toEqual(['/guides/path/a/']);
  });

  test('test_corrupt_value_reads_as_empty', () => {
    expect(readSet(memory('{"x":1}')).size).toBe(0);
    expect(readSet(memory('not json')).size).toBe(0);
    expect(readSet(memory('[1, "/a/"]')).size).toBe(0);
    const s = memory('not json');
    markRead(s, '/p/');
    expect(s.value).toBe('["/p/"]');
  });

  test('test_storage_that_throws_reads_as_empty', () => {
    expect(readSet(throwing).size).toBe(0);
    expect(() => markRead(throwing, '/p/')).not.toThrow();
    expect(readSet(null).size).toBe(0);
    expect(() => markRead(null, '/p/')).not.toThrow();
  });
});

describe('progress', () => {
  test('test_progress_counts_per_track', () => {
    const links = [
      { path: '/guides/path/a/', track: 'path' },
      { path: '/guides/path/b/', track: 'path' },
      { path: '/guides/contributing/wordpress/c/', track: 'contributing-wordpress' },
      { path: '/guides/topics/hooks/', track: 'topics' },
    ];
    const p = progress(links, new Set(['/guides/path/b/', '/guides/topics/hooks/']));
    expect(Object.fromEntries(p)).toEqual({ path: { read: 1, total: 2 }, 'contributing-wordpress': { read: 0, total: 1 } });
  });

  test('test_progress_single_guide_track', () => {
    expect(progress([{ path: '/guides/path/a/', track: 'path' }], new Set()).get('path')).toEqual({ read: 0, total: 1 });
  });

  test('test_progress_counts_a_link_listed_twice_once', () => {
    const links = [
      { path: '/guides/path/a/', track: 'path' },
      { path: '/guides/path/a/', track: 'path' },
    ];
    expect(progress(links, new Set(['/guides/path/a/'])).get('path')).toEqual({ read: 1, total: 1 });
  });
});
