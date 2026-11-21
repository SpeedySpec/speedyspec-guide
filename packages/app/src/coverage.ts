import type { Assignment, ContentPage, Seam } from '@speedyspec-guide/domain';

/** `generated/coverage.json`: per seam, how many of its pages are written, and what is missing. */
export interface CoverageFile {
  seams: { id: string; ported: boolean; members: number; wordpressPages: number; speedyspecPages: number; missing: string[] }[];
  unassigned: number;
}

/**
 * Counts, per seam, the members with a WordPress page and with a SpeedySpec page. Methods count toward their class.
 * A member is missing when it lacks its WordPress page, or, in a ported seam, either page.
 */
export function computeCoverage(assignment: Assignment, seams: Seam[], pages: ContentPage[]): CoverageFile {
  const written = (section: 'wordpress' | 'speedyspec') => new Set(pages.filter((p) => p.section === section && p.symbol).map((p) => p.symbol!));
  const wp = written('wordpress');
  const ss = written('speedyspec');
  return {
    seams: seams.map((seam) => {
      const members = Object.entries(assignment.seamOf)
        .filter(([id, s]) => s === seam.id && !id.startsWith('method:'))
        .map(([id]) => id)
        .sort();
      const missing = members.filter((id) => !wp.has(id) || (seam.ported && !ss.has(id)));
      return {
        id: seam.id,
        ported: seam.ported,
        members: members.length,
        wordpressPages: members.filter((id) => wp.has(id)).length,
        speedyspecPages: members.filter((id) => ss.has(id)).length,
        missing,
      };
    }),
    unassigned: assignment.unassigned.length,
  };
}
