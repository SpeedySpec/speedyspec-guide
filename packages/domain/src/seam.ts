import type { Citation } from './citation.ts';
import type { Edge } from './graph.ts';

/** A boundary where behaviour can be swapped, and the symbols on it. Plain object. */
export interface Seam {
  id: string;
  name: string;
  job: string;
  ported: boolean;
  files: string[];
  symbols: string[];
  exclude: string[];
  /** APIs in this seam's files that are documented elsewhere, so the guide leaves their symbols out. */
  elsewhere: Elsewhere[];
  /** Functions no example can run, such as those that end the request, which the coverage gate checks for a page only. */
  unrunnable?: Unrunnable[];
  roles: Record<string, string[]>;
  edges: Edge[];
  /** WordPress files an example of this seam loads first, on the WordPress side (relative to the release). */
  wordpress: string[];
  /** A PHP file run after `wordpress` and before each example on the WordPress side (absolute), such as a fresh database. */
  setup?: string;
  /** Whether its examples need the MySQL database in `GUIDE_MYSQL_URL` (seam.yaml `mysql: true`). */
  mysql?: boolean;
  /** SpeedySpec crates that implement it. */
  crates?: string[];
  /** The SpeedySpec state of each cross-seam dependency, by target symbol id, with the evidence for it. */
  dependencies?: Record<string, { state: DependencyState; cite: Citation }>;
}

/**
 * An API WordPress bundles but doesn't own, such as a polyfill of a PHP extension: its own documentation describes
 * it, so the guide leaves its symbols out and links there instead.
 */
export interface Elsewhere {
  /** What the API is, as the note names it. */
  name: string;
  /** Where it is documented (https). */
  docs: string;
  /** The files that hold it, relative to the release; globs allowed. */
  files: string[];
  /** Why it is documented there, for the note. */
  note: string;
}

/** How a ported seam reaches another seam: still through WordPress's PHP, behind an outbound port, or in Rust. */
export type DependencyState = 'php' | 'port' | 'rust';

/** Which seam each symbol belongs to. */
export interface Assignment {
  seamOf: Record<string, string>;
  unassigned: string[];
  conflicts: { symbol: string; seams: string[] }[];
}

/** A function of a seam that no example can run on WordPress, and why, so the coverage gate asks for its page only. */
export interface Unrunnable {
  /** The function's symbol id, such as `function:redirect_post`. */
  symbol: string;
  /** Why no example can run it, for readers and reviewers. */
  reason: string;
}
