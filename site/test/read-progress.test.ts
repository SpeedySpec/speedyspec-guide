import { describe, expect, test } from 'bun:test';
import { browserStore, type KeyValueStore, markRead, mount, progress, READ_KEY, readSet } from '../src/scripts/read-progress.ts';

/** A sidebar link as mount() reads it. */
class FakeLink {
  attrs = new Set<string>();
  constructor(public dataset: Record<string, string>) {}
  toggleAttribute(name: string, on: boolean) {
    if (on) this.attrs.add(name);
    else this.attrs.delete(name);
  }
}

/** A progress bar as mount() fills it. */
class FakeBar {
  label = { textContent: '' };
  props: Record<string, string> = {};
  style = { setProperty: (k: string, v: string) => (this.props[k] = v) };
  constructor(public dataset: Record<string, string>) {}
  querySelector(sel: string) {
    return sel === '.progress-label' ? this.label : null;
  }
}

/** A page with guide links, progress bars, a guide end, and a window that scrolls and observes. */
function fakePage(path: string, withEnd = true) {
  const links = [
    new FakeLink({ guide: '/guides/path/a/', guideTrack: 'path' }),
    new FakeLink({ guide: '/guides/path/b/', guideTrack: 'path' }),
    new FakeLink({ guide: '/guides/topics/hooks/', guideTrack: 'topics' }),
  ];
  const bars = [new FakeBar({ progressTrack: 'path' })];
  const end = {};
  let observed: ((entries: { isIntersecting: boolean }[]) => void) | null = null;
  let onScroll: (() => void) | null = null;
  const view = {
    IntersectionObserver: class {
      constructor(cb: (entries: { isIntersecting: boolean }[]) => void) {
        observed = cb;
      }
      observe() {}
      disconnect() {
        observed = null;
      }
    },
    addEventListener: (type: string, cb: () => void) => {
      if (type === 'scroll') onScroll = cb;
    },
    removeEventListener: (type: string) => {
      if (type === 'scroll') onScroll = null;
    },
  };
  const doc = {
    location: { pathname: path },
    defaultView: view,
    querySelectorAll: (sel: string) => (sel === 'a[data-guide]' ? links : sel === '[data-progress-track]' ? bars : []),
    querySelector: (sel: string) => (sel === '.guide-end' && withEnd ? end : null),
  };
  return {
    doc: doc as unknown as Document,
    links,
    bars,
    endVisible: (on: boolean) => observed?.([{ isIntersecting: on }]),
    scroll: () => onScroll?.(),
  };
}

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

describe('mount', () => {
  test('test_mount_ticks_read_links_and_fills_bars', () => {
    const s = memory('["/guides/path/b/","/guides/topics/hooks/"]');
    const page = fakePage('/guides/path/a/');
    mount(page.doc, s);
    expect(page.links.map((l) => l.attrs.has('data-read'))).toEqual([false, true, true]);
    expect(page.bars[0]!.label.textContent).toBe('1 of 2 read');
    expect(page.bars[0]!.props['--progress']).toBe('50%');
  });

  test('test_mount_marks_read_once_the_reader_scrolls_to_the_end', () => {
    const s = memory();
    const page = fakePage('/guides/path/a/');
    mount(page.doc, s);
    page.scroll();
    page.endVisible(true);
    expect([...readSet(s)]).toEqual(['/guides/path/a/']);
    expect(page.links[0]!.attrs.has('data-read')).toBe(true);
    expect(page.bars[0]!.label.textContent).toBe('1 of 2 read');
  });

  test('test_mount_does_not_mark_a_guide_whose_end_shows_on_open', () => {
    const s = memory();
    const page = fakePage('/guides/path/a/');
    mount(page.doc, s);
    page.endVisible(true);
    expect(readSet(s).size).toBe(0);
    page.scroll();
    expect([...readSet(s)]).toEqual(['/guides/path/a/']);
  });

  test('test_mount_does_not_mark_when_the_end_has_scrolled_away', () => {
    const s = memory();
    const page = fakePage('/guides/path/a/');
    mount(page.doc, s);
    page.endVisible(true);
    page.endVisible(false);
    page.scroll();
    expect(readSet(s).size).toBe(0);
  });

  test('test_mount_without_a_guide_end_only_shows_ticks', () => {
    const s = memory('["/guides/path/a/"]');
    const page = fakePage('/reference/', false);
    mount(page.doc, s);
    page.scroll();
    expect(page.links[0]!.attrs.has('data-read')).toBe(true);
    expect([...readSet(s)]).toEqual(['/guides/path/a/']);
  });

  test('test_mount_with_storage_that_throws_does_not_throw', () => {
    const page = fakePage('/guides/path/a/');
    expect(() => {
      mount(page.doc, throwing);
      page.scroll();
      page.endVisible(true);
    }).not.toThrow();
    expect(page.bars[0]!.label.textContent).toBe('0 of 2 read');
  });
});

describe('browserStore', () => {
  test('test_browser_store_is_null_when_storage_refuses_access', () => {
    const had = Object.getOwnPropertyDescriptor(globalThis, 'localStorage');
    Object.defineProperty(globalThis, 'localStorage', { configurable: true, get: () => { throw new Error('SecurityError'); } });
    try {
      expect(browserStore()).toBeNull();
    } finally {
      if (had) Object.defineProperty(globalThis, 'localStorage', had);
      else delete (globalThis as { localStorage?: unknown }).localStorage;
    }
  });

  test('test_browser_store_returns_local_storage', () => {
    const had = Object.getOwnPropertyDescriptor(globalThis, 'localStorage');
    const store = memory();
    Object.defineProperty(globalThis, 'localStorage', { configurable: true, value: store });
    try {
      expect(browserStore()).toBe(store);
    } finally {
      if (had) Object.defineProperty(globalThis, 'localStorage', had);
      else delete (globalThis as { localStorage?: unknown }).localStorage;
    }
  });
});
