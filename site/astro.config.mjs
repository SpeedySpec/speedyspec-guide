// @ts-check
import mdx from '@astrojs/mdx';
import starlight from '@astrojs/starlight';
import { defineConfig } from 'astro/config';

export default defineConfig({
  output: 'static',
  trailingSlash: 'always',
  integrations: [
    // Every route renders through layouts/Page.astro (Starlight's page component); Starlight's own docs collection
    // stays empty. The overrides add the site's header links, guide progress and chapter labels.
    starlight({
      title: 'SpeedySpec Guide',
      customCss: ['./src/styles/guide.css'],
      disable404Route: true,
      pagefind: true,
      components: {
        SiteTitle: './src/components/starlight/SiteTitle.astro',
        MobileMenuFooter: './src/components/starlight/MobileMenuFooter.astro',
      },
    }),
    mdx(),
  ],
  // MDX pages draw diagrams with <Diagram code={...} label="..." />, rendered in a process of its own like the
  // generated ones; rendering inside the build process (rehype-mermaid) could stall the build.
});
