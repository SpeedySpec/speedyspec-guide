import type { ContentPage, Inventory, PageCitation, PageVersion, Seam } from '@speedyspec-guide/domain';

/** Extracts the inventory of a code base. */
export interface SymbolSource {
  extract(root: string, base: 'wp' | 'ss', version: string): Promise<Inventory>;
}

/** Provides an extracted WordPress release. */
export interface ReleaseSource {
  /** Returns the directory holding the release's code. */
  fetch(version: string): Promise<string>;
}

/** Reads the seam map. Repository. */
export interface SeamRepository {
  all(): Promise<Seam[]>;
}

/** Answers whether cited evidence exists. */
export interface EvidenceSource {
  scenarioExists(area: string, name: string): Promise<boolean>;
  breakExists(area: string, scenario: string, step?: number): Promise<boolean>;
  testExists(path: string): Promise<boolean>;
  /** The cited lines' text, or null when the file or lines don't exist. */
  sourceLines(base: 'wp' | 'ss', file: string, from: number, to: number): Promise<string | null>;
}

/** Release tags of a code base, and their code. */
export interface ReleaseHistory {
  tags(): Promise<string[]>;
  /** Returns a directory holding the tag's PHP. */
  checkout(tag: string): Promise<string>;
}

/** Where pipeline stages read and write their outputs (`generated/*.json`). */
export interface GeneratedStore {
  read<T>(name: string): Promise<T | null>;
  write(name: string, data: unknown): Promise<void>;
}

/** The documentation pages, and the citations and versions written in them. */
export interface ContentPages {
  pages(): Promise<ContentPage[]>;
  citations(): Promise<PageCitation[]>;
  versions(): Promise<PageVersion[]>;
}
