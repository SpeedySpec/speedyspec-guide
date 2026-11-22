/**
 * Which guides a reader has finished, kept in their own browser only. A guide counts as read once its end (the
 * `.guide-end` marker after the prose) has scrolled into view. The sidebar's guide links (`a[data-guide]`) get
 * `data-read`, and each `[data-progress-track]` bar shows how far through its track the reader is.
 */

/** The browser storage key holding the read guides' paths. */
export const READ_KEY = 'speedyspec-guide:read';

/** The part of Web Storage this uses. */
export interface KeyValueStore {
  getItem(k: string): string | null;
  setItem(k: string, v: string): void;
}

/**
 * The paths of the guides read so far.
 *
 * @param store
 *     Browser storage, or null where there is none.
 * @return
 *     The read paths; empty when storage is missing, refuses access, or holds anything but a list of strings.
 */
export function readSet(store: KeyValueStore | null): Set<string> {
  try {
    const value: unknown = JSON.parse(store?.getItem(READ_KEY) ?? '[]');
    return Array.isArray(value) && value.every((v) => typeof v === 'string') ? new Set(value) : new Set();
  } catch {
    return new Set();
  }
}

/**
 * Records a guide as read. Does nothing where storage is missing or refuses to save.
 *
 * @param store
 *     Browser storage, or null where there is none.
 * @param path
 *     The guide's path.
 */
export function markRead(store: KeyValueStore | null, path: string): void {
  const read = readSet(store);
  read.add(path);
  try {
    store?.setItem(READ_KEY, JSON.stringify([...read]));
  } catch {
    // Private browsing or a full quota: the tick just doesn't stick.
  }
}

/**
 * How far through each ordered track the reader is. Topics have no order, so they get ticks but no count.
 *
 * @param links
 *     The guide links on the page, with their tracks; a path listed more than once counts once.
 * @param read
 *     The read paths.
 * @return
 *     Read and total guides per track, topics left out.
 */
export function progress(links: { path: string; track: string }[], read: Set<string>): Map<string, { read: number; total: number }> {
  const byTrack = new Map<string, Set<string>>();
  for (const l of links) {
    if (l.track === 'topics') continue;
    byTrack.set(l.track, (byTrack.get(l.track) ?? new Set()).add(l.path));
  }
  return new Map([...byTrack].map(([track, paths]) => [track, { read: [...paths].filter((p) => read.has(p)).length, total: paths.size }]));
}

function show(doc: Document, store: KeyValueStore | null): void {
  const read = readSet(store);
  const anchors = [...doc.querySelectorAll<HTMLAnchorElement>('a[data-guide]')];
  for (const a of anchors) a.toggleAttribute('data-read', read.has(a.dataset.guide!));
  const counts = progress(anchors.map((a) => ({ path: a.dataset.guide!, track: a.dataset.guideTrack ?? 'topics' })), read);
  for (const bar of doc.querySelectorAll<HTMLElement>('[data-progress-track]')) {
    const c = counts.get(bar.dataset.progressTrack!) ?? { read: 0, total: 0 };
    const label = bar.querySelector('.progress-label');
    if (label) label.textContent = `${c.read} of ${c.total} read`;
    bar.style.setProperty('--progress', c.total > 0 ? `${(100 * c.read) / c.total}%` : '0%');
  }
}

/**
 * Marks the read guides in the sidebar, fills the progress bars, and marks this guide read once the reader has
 * scrolled and its end is on screen. Opening a guide whose end already shows, and leaving, doesn't count.
 *
 * @param doc
 *     The page; its window (doc.defaultView) supplies scrolling and IntersectionObserver.
 * @param store
 *     Browser storage, or null where there is none.
 */
export function mount(doc: Document, store: KeyValueStore | null): void {
  show(doc, store);
  const end = doc.querySelector('.guide-end');
  const view = doc.defaultView;
  if (!end || !view || typeof view.IntersectionObserver === 'undefined') return;
  let endVisible = false;
  let scrolled = false;
  const finish = () => {
    if (!endVisible || !scrolled) return;
    seen.disconnect();
    view.removeEventListener('scroll', onScroll);
    markRead(store, doc.location.pathname);
    show(doc, store);
  };
  const onScroll = () => {
    scrolled = true;
    finish();
  };
  const seen = new view.IntersectionObserver((entries) => {
    endVisible = entries.some((e) => e.isIntersecting);
    finish();
  });
  view.addEventListener('scroll', onScroll, { passive: true });
  seen.observe(end);
}

/**
 * Browser storage.
 *
 * @return
 *     localStorage, or null where there is none or reading it throws (some privacy settings do).
 */
export function browserStore(): KeyValueStore | null {
  try {
    return globalThis.localStorage ?? null;
  } catch {
    return null;
  }
}
