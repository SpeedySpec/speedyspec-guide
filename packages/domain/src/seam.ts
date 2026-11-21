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
}

/** Which seam each symbol belongs to. */
export interface Assignment {
  seamOf: Record<string, string>;
  unassigned: string[];
  conflicts: { symbol: string; seams: string[] }[];
}
