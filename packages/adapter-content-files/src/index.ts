import type { ContentPages } from '@speedyspec-guide/contracts';
import { type ContentPage, type PageCitation, type PageVersion, parseCitation } from '@speedyspec-guide/domain';
import { existsSync } from 'node:fs';
import { join, sep } from 'node:path';

const TAG = (name: string) => new RegExp(`<${name}\\s+([^>]*?)\\/?>`, 'g');
const ATTR = /(\w+)="([^"]*)"/g;

function attrs(text: string): Record<string, string> {
  return Object.fromEntries([...text.matchAll(ATTR)].map((m) => [m[1]!, m[2]!]));
}

/** Pages under `content/wordpress/<seam>/` and `content/speedyspec/<seam>/`, read from MDX files. */
export class ContentFiles implements ContentPages {
  private cache: (ContentPage & { text: string })[] | null = null;

  constructor(private readonly dir: string) {}

  async pages(): Promise<ContentPage[]> {
    return (await this.read()).map(({ page, section, seam }) => ({ page, section, seam }));
  }

  /** Every `<Ev …/>`. */
  async citations(): Promise<PageCitation[]> {
    const out: PageCitation[] = [];
    for (const p of await this.read()) {
      for (const m of p.text.matchAll(TAG('Ev'))) {
        out.push({ page: p.page, section: p.section, seam: p.seam, citation: parseCitation(attrs(m[1]!)) });
      }
    }
    return out;
  }

  /** Every version named in `<Changed>`, `<Deprecated>` or `<Removed>` (`base` defaults to `ss`). */
  async versions(): Promise<PageVersion[]> {
    const out: PageVersion[] = [];
    for (const p of await this.read()) {
      for (const tag of ['Changed', 'Deprecated', 'Removed']) {
        for (const m of p.text.matchAll(TAG(tag))) {
          const a = attrs(m[1]!);
          if (a.version !== undefined) out.push({ page: p.page, version: a.version, base: a.base === 'wp' ? 'wp' : 'ss' });
        }
      }
    }
    return out;
  }

  private async read(): Promise<(ContentPage & { text: string })[]> {
    if (this.cache) return this.cache;
    const out: (ContentPage & { text: string })[] = [];
    if (existsSync(this.dir)) {
      for (const section of ['wordpress', 'speedyspec'] as const) {
        for await (const file of new Bun.Glob(`${section}/*/**/*.mdx`).scan({ cwd: this.dir })) {
          const page = file.split(sep).join('/');
          out.push({ page, section, seam: page.split('/')[1]!, text: await Bun.file(join(this.dir, file)).text() });
        }
      }
    }
    this.cache = out.sort((a, b) => (a.page < b.page ? -1 : 1));
    return this.cache;
  }
}
