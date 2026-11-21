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
  roles: Record<string, string[]>;
  edges: Edge[];
  /** WordPress files an example of this seam loads first, on the WordPress side (relative to the release). */
  wordpress: string[];
  /** WordPress packages that implement the seam. */
  packages?: string[];
  /** Fork packages (`packages/wp-<x>`) whose WordPress symbols this seam takes. */
  forkPackages?: string[];
  /** False when SpeedySpec's packages/ tree doesn't carry the seam's code, so its symbols get no fork verdict. */
  inFork?: boolean;
  /** SpeedySpec crates that implement it. */
  crates?: string[];
  /** The SpeedySpec state of each cross-seam dependency, by target symbol id, with the evidence for it. */
  dependencies?: Record<string, { state: DependencyState; cite: Citation }>;
}

/** How a ported seam reaches another seam: still through WordPress's PHP, behind an outbound port, or in Rust. */
export type DependencyState = 'php' | 'port' | 'rust';

/** Which seam each symbol belongs to. */
export interface Assignment {
  seamOf: Record<string, string>;
  unassigned: string[];
  conflicts: { symbol: string; seams: string[] }[];
}
