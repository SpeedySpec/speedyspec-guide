export type SymbolKind = 'function' | 'class' | 'method' | 'constant' | 'global' | 'filter' | 'action';

/** One documented thing: a function, class, method, constant, global or hook. Plain object. */
export interface GuideSymbol {
  id: string;
  kind: SymbolKind;
  name: string;
  file: string;
  line: number;
  signature?: string;
  pluggable?: boolean;
  dynamic?: boolean;
  /** Other declarations of the same id, as `file:line`. */
  alternates?: string[];
  /** sha256 of the symbol's syntax tree with comments stripped. */
  hash?: string;
}
