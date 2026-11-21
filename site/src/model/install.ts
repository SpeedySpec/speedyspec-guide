/**
 * The installation guide: a short run of hand-written pages under content/install/, read in order.
 * Apart from the per-seam API pages, which are reached by seam and symbol.
 */

/** One page of the installation guide: content/install/<slug>.mdx. */
export interface InstallPage {
  slug: string;
  title: string;
  /** One sentence for the guide's table of contents. */
  summary: string;
  /** Where the page comes in the guide; lower first. */
  order: number;
  /** The path relative to the content folder, as the content collection names it. */
  file: string;
}

/** The guide's first page, the one at /install/. */
export const INSTALL_INDEX = 'index';

/** The page's address: the first page at /install/, every other at /install/<slug>/. */
export function installPath(slug: string): string {
  return slug === INSTALL_INDEX ? '/install/' : `/install/${slug}/`;
}

/**
 * Turns a content file's slug and front matter into a page, refusing front matter the guide cannot place: a page
 * without a title or an order would be left out of the contents or put in an arbitrary place.
 */
export function installPage(slug: string, data: Record<string, unknown>, file: string): InstallPage {
  if (!/^[a-z0-9]+(-[a-z0-9]+)*$/.test(slug)) throw new Error(`${file}: the file name must be lowercase words joined by hyphens`);
  const { title, summary, order } = data;
  if (typeof title !== 'string' || title.trim() === '') throw new Error(`${file}: front matter needs a title`);
  if (typeof order !== 'number' || !Number.isFinite(order)) throw new Error(`${file}: front matter needs a numeric order`);
  if (summary !== undefined && typeof summary !== 'string') throw new Error(`${file}: summary must be text`);
  return { slug, title, summary: summary ?? '', order, file };
}

/** The pages in reading order. Two pages with the same order are refused, since neither would be first. */
export function inReadingOrder(pages: InstallPage[]): InstallPage[] {
  const sorted = [...pages].sort((a, b) => a.order - b.order);
  for (let i = 1; i < sorted.length; i++) {
    if (sorted[i]!.order === sorted[i - 1]!.order) {
      throw new Error(`${sorted[i - 1]!.file} and ${sorted[i]!.file} have the same order, ${sorted[i]!.order}`);
    }
  }
  return sorted;
}

/** The pages before and after `slug` in reading order, or null at either end. */
export function installNeighbours(pages: InstallPage[], slug: string): { previous: InstallPage | null; next: InstallPage | null } {
  const ordered = inReadingOrder(pages);
  const at = ordered.findIndex((p) => p.slug === slug);
  if (at === -1) return { previous: null, next: null };
  return { previous: ordered[at - 1] ?? null, next: ordered[at + 1] ?? null };
}
