import type { ContentPage, Example, Guide, ExampleRun, GuideSymbol, Inventory, PageCitation, PageVersion, Seam, Side } from '@speedyspec-guide/domain';

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
  /**
   * The WordPress release an area's compat scenarios were recorded against: compat/<area>/source.json's override, else
   * the pin in compat/wordpress.json; null when the area has none.
   */
  compatVersion(area: string): Promise<string | null>;
  /** An area's compat scenarios and breaks, or null when it has none. */
  /**
   * An area's scenarios and breaks, and, when its results were recorded, the labels of the recorders that fired in
   * each scenario (`rec:<hook name>`), from every `wordpress-*.json` beside them.
   */
  catalogue(area: string): Promise<{ scenarios: { name: string; steps: { call: string; args?: unknown[] }[] }[]; breaks: { scenario: string; step?: number; why: string }[]; fired?: Record<string, string[]> } | null>;
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

/** The developer guides under `content/guides/`. Repository. */
export interface GuideSource {
  guides(): Promise<Guide[]>;
}

/** A problem with an example file, reported rather than skipped. */
export interface ExampleProblem {
  where: string;
  message: string;
}

/** The examples on disk, and what is wrong with any of them. */
export interface ExampleSource {
  all(): Promise<{ examples: Example[]; problems: ExampleProblem[] }>;
}

/** One example as the runner gets it. */
export interface RunnerExample {
  id: string;
  file: string;
  load: string[];
  setup: string | null;
  multisite: boolean;
}

/** Runs example files on one side, and lists what PHP declares. */
export interface ExampleRunner {
  /** `setup` (absolute) runs after `load`, with `multisite` as `GUIDE_MULTISITE`, on the WordPress side only. */
  run(side: Side, examples: RunnerExample[], wordpressDir: string): Promise<ExampleRun[]>;
  reflect(mode: 'baseline' | 'runtime'): Promise<GuideSymbol[]>;
}

/** The Cargo.toml of every crate in the pinned speedyspec-server checkout. */
export interface CrateSource {
  manifests(): Promise<{ path: string; text: string }[]>;
  /**
   * A folder holding the PHP facades speedyspec-server's ports declare WordPress's API from
   * (`crates/speedyspec-wp-*-php/src/*.php`), for the PHP extractor.
   */
  facades(): Promise<string>;
}
