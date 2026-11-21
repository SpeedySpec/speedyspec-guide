import { glob } from 'astro/loaders';
import { defineCollection, z } from 'astro:content';
import { guideDirs } from './model/data.ts';

const VERDICTS = ['works-as-wordpress', 'works-with-differences', 'breaks', 'new-in-speedyspec'] as const;

/** The hand-written pages: content/<section>/<seam>/<slug>.mdx. The id is the path without .mdx, unchanged. */
const pages = defineCollection({
  loader: glob({ pattern: '{wordpress,speedyspec}/*/*.mdx', base: guideDirs().content, generateId: ({ entry }) => entry.replace(/\.mdx$/, '') }),
  schema: z.object({
    symbol: z.string().optional(),
    verdict: z.enum(VERDICTS).optional(),
    differences: z.array(z.object({ summary: z.string(), break: z.string().optional() })).optional(),
  }),
});

export const collections = { pages };
