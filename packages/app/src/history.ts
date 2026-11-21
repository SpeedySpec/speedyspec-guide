import type { ReleaseHistory, SymbolSource } from '@speedyspec-guide/contracts';
import { Version } from '@speedyspec-guide/domain';

/** `generated/wordpress-history.json`: the tags parsed so far, and each symbol's since and removed. */
export interface HistoryFile {
  tags: string[];
  symbols: Record<string, { since: string; removed?: string }>;
}

/**
 * Works out each symbol's first release and the first later release without it, parsing only tags not yet in the
 * cache. New tags are taken in version order after the cached ones.
 */
export async function computeHistory(history: ReleaseHistory, source: SymbolSource, cache: HistoryFile): Promise<HistoryFile> {
  const done = new Set(cache.tags);
  const symbols: HistoryFile['symbols'] = structuredClone(cache.symbols);
  const tags = [...cache.tags];
  const fresh = (await history.tags()).filter((t) => !done.has(t)).sort((a, b) => Version.parse(a).compare(Version.parse(b)));

  for (const tag of fresh) {
    const dir = await history.checkout(tag);
    const present = new Set((await source.extract(dir, 'wp', tag)).symbols.map((s) => s.id));
    for (const id of present) {
      const entry = symbols[id];
      if (entry === undefined) symbols[id] = { since: tag };
      else if (entry.removed !== undefined) delete entry.removed;
    }
    for (const [id, entry] of Object.entries(symbols)) {
      if (!present.has(id) && entry.removed === undefined) entry.removed = tag;
    }
    tags.push(tag);
  }
  return { tags, symbols };
}
