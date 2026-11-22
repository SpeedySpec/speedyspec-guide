import type { ContentPages, GuideSource } from '@speedyspec-guide/contracts';
import { type ContentPage, type Guide, type PageCitation, type PageVersion, parseCitation } from '@speedyspec-guide/domain';
import { existsSync } from 'node:fs';
import { join, sep } from 'node:path';
import { parse } from 'yaml';

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
    return (await this.read()).map(({ page, section, seam, text }) => {
      const front = /^---\r?\n([\s\S]*?)\r?\n?---/.exec(text)?.[1];
      const data = front ? (parse(front) as Record<string, unknown> | null) : null;
      const symbol = typeof data?.symbol === 'string' ? data.symbol : undefined;
      return symbol ? { page, section, seam, symbol } : { page, section, seam };
    });
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

/** A file of a numbered track: `<nn>-<slug>.mdx`. */
const NUMBERED = /^(\d{2})-(.+)\.mdx$/;

/**
 * The developer guides under `content/guides/`: the learning path (`path/`), topic guides (`topics/<seam>.mdx`) and the
 *  contributing track (`contributing/{wordpress,speedyspec}/`). Repository, with a Data Mapper from each file's front
 *  matter and its `<Example>` and `<Sym>` tags to a `Guide`.
 */
export class GuideFiles implements GuideSource {
  constructor(private readonly dir: string) {}

  async guides(): Promise<Guide[]> {
    const root = join(this.dir, 'guides');
    if (!existsSync(root)) return [];
    const out: Guide[] = [];
    for (const folder of ['path', 'topics', 'contributing/wordpress', 'contributing/speedyspec']) {
      if (!existsSync(join(root, folder))) continue;
      for await (const found of new Bun.Glob('*.mdx').scan({ cwd: join(root, folder) })) {
        out.push(this.map(`guides/${folder}/${found}`, await Bun.file(join(root, folder, found)).text()));
      }
    }
    return out.sort((a, b) => (a.file < b.file ? -1 : 1));
  }

  /** Data Mapper: one guide file to its `Guide`. */
  private map(file: string, text: string): Guide {
    const front = /^---\r?\n([\s\S]*?)\r?\n?---/.exec(text)?.[1];
    const data = front ? ((parse(front) as Record<string, unknown> | null) ?? {}) : {};
    const str = (v: unknown) => (typeof v === 'string' ? v : '');
    const tagged = (name: string) => [...text.matchAll(TAG(name))].map((m) => attrs(m[1]!).id).filter((id): id is string => typeof id === 'string');
    const parts = file.split('/');
    const name = parts[parts.length - 1]!;
    const base = { file, title: str(data.title), summary: str(data.summary), examples: tagged('Example'), symbols: tagged('Sym') };
    if (parts[1] === 'topics') {
      const seam = name.slice(0, -'.mdx'.length);
      return { ...base, kind: 'topic', slug: seam, seam };
    }
    const numbered = NUMBERED.exec(name);
    const slug = numbered ? numbered[2]! : name.slice(0, -'.mdx'.length);
    const order = numbered ? Number(numbered[1]) : undefined;
    const placed = order === undefined ? {} : { order };
    if (parts[1] === 'contributing') return { ...base, kind: 'contributing', part: parts[2] as 'wordpress' | 'speedyspec', slug, ...placed };
    return { ...base, kind: 'path', slug, ...placed };
  }
}
