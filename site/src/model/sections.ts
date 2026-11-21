/** What the section index and seam pages list, and which symbol pages exist. */
import type { GuideData } from './data.ts';
import { assertUniqueSlugs, symbolSlug } from './slug.ts';

/** Every symbol with its own page in a seam: everything assigned to it except methods (they live on their class). */
export function pageSymbols(seamId: string, d: GuideData): string[] {
  return Object.entries(d.assignment.seamOf)
    .filter(([id, s]) => s === seamId && !id.startsWith('method:'))
    .map(([id]) => id)
    .sort();
}

/** The WordPress pages to build: one per page symbol of every seam, with unique slugs. */
export function wordpressPaths(d: GuideData): { seam: string; slug: string; id: string }[] {
  const out: { seam: string; slug: string; id: string }[] = [];
  for (const seam of d.seams) {
    const ids = pageSymbols(seam.id, d);
    assertUniqueSlugs(ids);
    for (const id of ids) out.push({ seam: seam.id, slug: symbolSlug(id), id });
  }
  return out;
}

/** How many of a seam's page symbols have a hand-written page in a section. */
export function documented(seamId: string, section: 'wordpress' | 'speedyspec', d: GuideData): { documented: number; total: number } {
  const ids = pageSymbols(seamId, d);
  const written = new Set(d.content.filter((c) => c.section === section && c.kind === 'symbol').map((c) => c.symbol));
  return { documented: ids.filter((id) => written.has(id)).length, total: ids.length };
}
