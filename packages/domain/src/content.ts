import type { Citation } from './citation.ts';

/** A documentation page, `content/<section>/<seam>/…/*.mdx`. */
export interface ContentPage {
  page: string;
  section: 'wordpress' | 'speedyspec';
  seam: string;
  /** The symbol the page is about, from its front matter (`symbol:`); absent on seam, porting and architecture pages. */
  symbol?: string;
}

export interface PageCitation extends ContentPage {
  citation: Citation;
}

export interface PageVersion {
  page: string;
  version: string;
  base: 'wp' | 'ss';
}
