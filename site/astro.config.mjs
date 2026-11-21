// @ts-check
import mdx from '@astrojs/mdx';
import { defineConfig } from 'astro/config';

export default defineConfig({
  output: 'static',
  trailingSlash: 'always',
  integrations: [mdx()],
  // MDX pages draw diagrams with <Diagram code={...} label="..." />, rendered in a process of its own like the
  // generated ones; rendering inside the build process (rehype-mermaid) could stall the build.
});
