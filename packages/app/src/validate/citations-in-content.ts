import { type Citation, parseCitation } from '@speedyspec-guide/domain';
import { existsSync } from 'node:fs';
import { join, sep } from 'node:path';

export interface PageCitation {
  page: string;
  section: 'wordpress' | 'speedyspec';
  seam: string;
  citation: Citation;
}

export interface PageVersion {
  page: string;
  version: string;
  base: 'wp' | 'ss';
}

const TAG = (name: string) => new RegExp(`<${name}\\s+([^>]*?)\\/?>`, 'g');
const ATTR = /(\w+)="([^"]*)"/g;

function attrs(text: string): Record<string, string> {
  return Object.fromEntries([...text.matchAll(ATTR)].map((m) => [m[1]!, m[2]!]));
}

async function pages(dir: string): Promise<{ page: string; section: 'wordpress' | 'speedyspec'; seam: string; text: string }[]> {
  const out = [];
  for (const section of ['wordpress', 'speedyspec'] as const) {
    for await (const file of new Bun.Glob(`${section}/*/**/*.mdx`).scan({ cwd: dir })) {
      const page = file.split(sep).join('/');
      out.push({ page, section, seam: page.split('/')[1]!, text: await Bun.file(join(dir, file)).text() });
    }
  }
  return out.sort((a, b) => (a.page < b.page ? -1 : 1));
}

/** Every `<Ev …/>` citation in `content/<section>/<seam>/**\/*.mdx`. */
export async function citationsIn(contentDir: string): Promise<PageCitation[]> {
  if (!existsSync(contentDir)) return [];
  const out: PageCitation[] = [];
  for (const p of await pages(contentDir)) {
    for (const m of p.text.matchAll(TAG('Ev'))) {
      out.push({ page: p.page, section: p.section, seam: p.seam, citation: parseCitation(attrs(m[1]!)) });
    }
  }
  return out;
}

/** Every version a page names in `<Changed>`, `<Deprecated>` or `<Removed>` (`base` defaults to `ss`). */
export async function versionsIn(contentDir: string): Promise<PageVersion[]> {
  if (!existsSync(contentDir)) return [];
  const out: PageVersion[] = [];
  for (const p of await pages(contentDir)) {
    for (const tag of ['Changed', 'Deprecated', 'Removed']) {
      for (const m of p.text.matchAll(TAG(tag))) {
        const a = attrs(m[1]!);
        if (a.version !== undefined) out.push({ page: p.page, version: a.version, base: a.base === 'wp' ? 'wp' : 'ss' });
      }
    }
  }
  return out;
}

