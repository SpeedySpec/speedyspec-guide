import type { GuideSymbol } from '@speedyspec-guide/domain';

/** `generated/speedyspec-history.json`: the runtime releases recorded, and each runtime symbol's since and removed. */
export interface RuntimeHistoryFile {
  versions: string[];
  symbols: Record<string, { since: string; removed?: string }>;
}

/**
 * Records the runtime's API at `version`. Before a version is released (tagged), a new symbol is `unreleased`; the
 * first released run gives it that version. Only a released run marks a missing symbol removed.
 */
export function updateRuntimeHistory(current: GuideSymbol[], version: string, released: boolean, file: RuntimeHistoryFile): RuntimeHistoryFile {
  const symbols: RuntimeHistoryFile['symbols'] = structuredClone(file.symbols);
  const present = new Set(current.map((s) => s.id));
  const since = released ? version : 'unreleased';
  for (const id of present) {
    const entry = symbols[id];
    if (entry === undefined) symbols[id] = { since };
    else {
      if (entry.since === 'unreleased' && released) entry.since = version;
      if (entry.removed !== undefined) delete entry.removed;
    }
  }
  if (released) {
    for (const [id, entry] of Object.entries(symbols)) if (!present.has(id) && entry.removed === undefined) entry.removed = version;
  }
  const versions = released && !file.versions.includes(version) ? [...file.versions, version] : [...file.versions];
  return { versions, symbols };
}
