import type { Citation } from './citation.ts';
import type { GuideSymbol } from './symbol.ts';

export type EdgeKind = 'calls' | 'reads' | 'writes' | 'fires' | 'runs' | 'matches' | 'alias' | 'undone-by';

export interface Edge {
  from: string;
  to: string;
  kind: EdgeKind;
  at?: Citation;
}

/** A call the extractor could not resolve to a symbol. */
export interface Unresolved {
  from: string;
  at: Citation;
  code: string;
}

/** Everything extracted from one code base. */
export interface Inventory {
  base: 'wp' | 'ss';
  version: string;
  symbols: GuideSymbol[];
  edges: Edge[];
  unresolved: Unresolved[];
  /** Files that could not be parsed. */
  errors?: { file: string; message: string }[];
}
