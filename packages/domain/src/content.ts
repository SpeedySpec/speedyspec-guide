import type { Citation } from './citation.ts';

/** A documentation page, `content/<section>/<seam>/…/*.mdx`. */
export interface ContentPage {
  page: string;
  section: 'wordpress' | 'speedyspec';
  seam: string;
}

export interface PageCitation extends ContentPage {
  citation: Citation;
}

export interface PageVersion {
  page: string;
  version: string;
  base: 'wp' | 'ss';
}
