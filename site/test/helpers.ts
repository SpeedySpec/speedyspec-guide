import { mkdtempSync } from 'node:fs';
import { tmpdir } from 'node:os';
import { join } from 'node:path';

const siteDir = join(import.meta.dir, '..');
const builds = new Map<string, { dist: string; exitCode: number; output: string }>();

/** Builds the site with the given environment into a temporary folder, once per distinct environment. */
export function buildSite(env: Record<string, string>): { dist: string; exitCode: number; output: string } {
  const key = JSON.stringify(Object.entries(env).sort());
  const cached = builds.get(key);
  if (cached) return cached;
  const dist = mkdtempSync(join(tmpdir(), 'guide-site-'));
  const p = Bun.spawnSync(['bunx', '--bun', 'astro', 'build', '--outDir', dist], {
    cwd: siteDir,
    env: { ...process.env, ...env },
  });
  const result = { dist, exitCode: p.exitCode ?? 1, output: p.stdout.toString() + p.stderr.toString() };
  builds.set(key, result);
  return result;
}

export interface Page {
  /** The text of every element matching the selector. */
  text(selector: string): string[];
  attr(selector: string, name: string): string[];
  count(selector: string): number;
  raw: string;
}

/** Reads a built page (`path` like `/wordpress/hooks/`) for assertions. */
export async function html(dist: string, path: string): Promise<Page> {
  const file = join(dist, path.replace(/^\//, ''), path.endsWith('/') ? 'index.html' : '');
  const raw = await Bun.file(file).text();
  return {
    raw,
    text: (selector) => collect(raw, selector),
    attr: (selector, name) => {
      const out: string[] = [];
      new HTMLRewriter().on(selector, { element: (el) => { const v = el.getAttribute(name); if (v !== null) out.push(v); } }).transform(raw);
      return out;
    },
    count: (selector) => {
      let n = 0;
      new HTMLRewriter().on(selector, { element: () => { n++; } }).transform(raw);
      return n;
    },
  };
}

function collect(raw: string, selector: string): string[] {
  const out: string[] = [];
  const open: { text: string }[] = [];
  new HTMLRewriter()
    .on(selector, {
      element(el) {
        const entry = { text: '' };
        open.push(entry);
        el.onEndTag(() => {
          open.splice(open.indexOf(entry), 1);
          out.push(decode(entry.text).replace(/\s+/g, ' ').trim());
        });
      },
      text(t) {
        for (const entry of open) entry.text += t.text;
      },
    })
    .transform(raw);
  return out;
}

/** Text with HTML entities decoded, as a reader sees it. */
function decode(text: string): string {
  const named: Record<string, string> = { amp: '&', lt: '<', gt: '>', quot: '"', apos: "'", nbsp: ' ' };
  return text.replace(/&(#x[0-9a-f]+|#\d+|[a-z]+);/gi, (m, e: string) =>
    e[0] === '#' ? String.fromCodePoint(e[1]?.toLowerCase() === 'x' ? Number.parseInt(e.slice(2), 16) : Number(e.slice(1))) : (named[e] ?? m),
  );
}
