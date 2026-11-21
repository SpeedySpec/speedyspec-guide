import type { ReleaseHistory, SymbolSource } from '@speedyspec-guide/contracts';
import { Version } from '@speedyspec-guide/domain';

/** `generated/wordpress-history.json`: the tags parsed so far, and each symbol's since and removed. */
export interface HistoryFile {
  tags: string[];
  symbols: Record<string, { since: string; removed?: string }>;
  /** Per tag, the files that could not be parsed. Nothing is marked removed in such a tag. */
  errors?: Record<string, string[]>;
}

/**
 * Works out each symbol's first release and the first later release without it, parsing only tags not yet in the
 * cache. New tags are taken in version order after the cached ones. `onProgress` receives the history after each tag,
 * so a long first run can be saved as it goes.
 */
export async function computeHistory(
  history: ReleaseHistory,
  source: SymbolSource,
  cache: HistoryFile,
  onProgress?: (h: HistoryFile) => Promise<void>,
): Promise<HistoryFile> {
  const done = new Set(cache.tags);
  const symbols: HistoryFile['symbols'] = structuredClone(cache.symbols);
  const errors: Record<string, string[]> = structuredClone(cache.errors ?? {});
  const tags = [...cache.tags];
  const fresh = (await history.tags()).filter((t) => !done.has(t)).sort((a, b) => Version.parse(a).compare(Version.parse(b)));

  for (const tag of fresh) {
    const dir = await history.checkout(tag);
    const inv = await source.extract(dir, 'wp', tag);
    const present = new Set(inv.symbols.map((s) => s.id));
    const failed = (inv.errors ?? []).map((e) => `${e.file}: ${e.message}`);
    if (failed.length > 0) errors[tag] = failed;
    for (const id of present) {
      const entry = symbols[id];
      if (entry === undefined) symbols[id] = { since: tag };
      else if (entry.removed !== undefined) delete entry.removed;
    }
    // A file that failed to parse would make its symbols look removed; leave removals to the next tag.
    if (failed.length === 0) {
      for (const [id, entry] of Object.entries(symbols)) {
        if (!present.has(id) && entry.removed === undefined) entry.removed = tag;
      }
    }
    tags.push(tag);
    if (onProgress) await onProgress(snapshot());
  }
  return snapshot();

  function snapshot(): HistoryFile {
    return Object.keys(errors).length > 0 ? { tags: [...tags], symbols, errors } : { tags: [...tags], symbols };
  }
}
