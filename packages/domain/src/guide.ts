/** Which track a developer guide belongs to. */
export type GuideKind = 'path' | 'topic' | 'contributing';

/**
 * A developer guide: prose that teaches, with the examples it embeds and the symbols it links. Plain object; it knows
 *  nothing of the files it was read from beyond their names.
 */
export interface Guide {
  /** The file, relative to the content folder, such as `guides/path/01-your-first-plugin.mdx`. */
  file: string;
  kind: GuideKind;
  /** The guide's slug; a topic guide's is its seam id. */
  slug: string;
  /** Which project a contributing guide is about. */
  part?: 'wordpress' | 'speedyspec';
  /** The guide's place in its track, from the file's two-digit prefix (learning path and contributing guides). */
  order?: number;
  /** The seam a topic guide explains. */
  seam?: string;
  title: string;
  summary: string;
  /** The ids of the examples it embeds, in page order. */
  examples: string[];
  /** The ids of the symbols it links, in page order. */
  symbols: string[];
}
