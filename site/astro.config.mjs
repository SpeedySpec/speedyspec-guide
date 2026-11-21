// @ts-check
import mdx from '@astrojs/mdx';
import { defineConfig } from 'astro/config';
import rehypeMermaid from 'rehype-mermaid';

export default defineConfig({
  output: 'static',
  trailingSlash: 'always',
  integrations: [mdx()],
  markdown: {
    // Diagrams written in MDX (```mermaid) become light and dark SVG at build time, like the generated ones.
    syntaxHighlight: { type: 'shiki', excludeLangs: ['mermaid'] },
    rehypePlugins: [[rehypeMermaid, { strategy: 'img-svg', dark: true }]],
  },
});
