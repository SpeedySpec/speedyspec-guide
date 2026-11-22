/**
 * Everything the site shows, loaded once: generated JSON, the seam map, example files and the MDX content.
 * The only module of the site that reads files.
 */
import { ExampleFiles } from '@speedyspec-guide/adapter-example-files';
import { SeamFiles } from '@speedyspec-guide/adapter-seam-files';
import type { CratesFile, Cycles, ExamplesFile, Graph, HistoryFile, RuntimeHistoryFile } from '@speedyspec-guide/app';
import type { Assignment, Example, GuideSymbol, Inventory, Seam } from '@speedyspec-guide/domain';

import { existsSync } from 'node:fs';
import { join, sep } from 'node:path';
import { fileURLToPath } from 'node:url';
import { parse } from 'yaml';
import type { Sources } from './wording.ts';

export type { CratesFile } from '@speedyspec-guide/app';

/**
 * The pseudo-seam holding the developer guides' examples: they run on a fully booted WordPress, but it documents no
 * symbols, so the site lists it as no seam.
 */
export const GUIDES_SEAM = 'guides';

export type ContentKind = 'symbol' | 'seam' | 'porting' | 'architecture';

/** One MDX file under content/: `<section>/<seam>/<slug>.mdx`. */
export interface ContentEntry {
  section: 'wordpress' | 'speedyspec';
  seam: string;
  slug: string;
  kind: ContentKind;
  symbol?: string;
  data: Record<string, unknown>;
  /** The MDX after the front matter. */
  body: string;
  /** The path relative to the content folder, as the content collection names it. */
  file: string;
}

/** An example and its PHP source. */
export interface ExampleFile extends Example {
  code: string;
}

export interface GuideData {
  inventory: Inventory;
  runtime: GuideSymbol[];
  assignment: Assignment;
  /** Runtime-only symbols that a seam lists, by id: they have SpeedySpec pages and no WordPress ones. */
  runtimeSeamOf: Record<string, string>;
  graph: Graph;
  cycles: Cycles;
  /**
   * Each WordPress symbol SpeedySpec has converted to Rust: `runtime` when the runtime registers it, `ported` when a
   * speedyspec-server port declares it but the runtime doesn't boot that port yet (generated/conversion.json).
   */
  conversion: Record<string, 'runtime' | 'ported'>;
  /** The WordPress release each seam's compat area was recorded against (generated/compat.json). */
  compatAreas: Record<string, string>;
  wordpressHistory: HistoryFile | null;
  speedyspecHistory: RuntimeHistoryFile | null;
  crates: CratesFile;
  examples: { files: ExampleFile[]; results: ExamplesFile | null };
  seams: Seam[];
  content: ContentEntry[];
  /** sources.json: what the evidence links point at. */
  sources: Sources | null;
}

const root = fileURLToPath(new URL('../../../', import.meta.url));

export function guideDirs(env: Record<string, string | undefined> = process.env) {
  return {
    data: env.GUIDE_DATA_DIR ?? join(root, 'generated'),
    seams: env.GUIDE_SEAMS_DIR ?? join(root, 'seams'),
    content: env.GUIDE_CONTENT_DIR ?? join(root, 'content'),
    sources: env.GUIDE_SOURCES ?? join(root, 'sources.json'),
  };
}

let loaded: Promise<GuideData> | null = null;

/** The guide's data for this build, read once. */
export function loadGuideData(): Promise<GuideData> {
  loaded ??= readGuideData(process.env);
  return loaded;
}

/** Reads the guide's data from the folders `env` names. A missing generated file gives its empty value. */
export async function readGuideData(env: Record<string, string | undefined>): Promise<GuideData> {
  const dirs = guideDirs(env);
  const json = async <T>(name: string, empty: T): Promise<T> => {
    const file = Bun.file(join(dirs.data, `${name}.json`));
    return (await file.exists()) ? ((await file.json()) as T) : empty;
  };
  // An empty site is almost always a mistake (the generated data wasn't made or copied): refuse it unless asked for.
  if (env.GUIDE_ALLOW_EMPTY !== '1') {
    for (const name of ['inventory-wp', 'assignment']) {
      if (!(await Bun.file(join(dirs.data, `${name}.json`)).exists())) {
        throw new Error(`${join(dirs.data, name)}.json is missing: run bun run guide all first, or set GUIDE_ALLOW_EMPTY=1 for an empty site`);
      }
    }
  }
  const allSeams = existsSync(dirs.seams) ? await new SeamFiles(dirs.seams).all() : [];
  const found = allSeams.length > 0 ? (await new ExampleFiles(dirs.seams, allSeams).all()).examples : [];
  const seams = allSeams.filter((s) => s.id !== GUIDES_SEAM);
  const examples: ExampleFile[] = await Promise.all(found.map(async (e) => ({ ...e, code: await Bun.file(e.file).text() })));
  const assignment = await json<Assignment>('assignment', { seamOf: {}, unassigned: [], conflicts: [] });
  const runtime = await json<GuideSymbol[]>('inventory-runtime', []);
  // Runtime symbols a seam lists in `symbols` belong to that seam, on the SpeedySpec side only (WordPress doesn't have them).
  const wordpressIds = new Set((await json<Inventory>('inventory-wp', { base: 'wp', version: '', symbols: [], edges: [], unresolved: [] })).symbols.map((s) => s.id));
  const runtimeSeamOf: Record<string, string> = {};
  for (const s of runtime) {
    const owner = seams.find((seam) => seam.symbols.includes(s.id));
    if (owner && !wordpressIds.has(s.id)) runtimeSeamOf[s.id] = owner.id;
  }
  return {
    inventory: await json<Inventory>('inventory-wp', { base: 'wp', version: '', symbols: [], edges: [], unresolved: [] }),
    runtime,
    assignment,
    runtimeSeamOf,
    graph: await json<Graph>('graph', { nodes: [], edges: [], crossSeam: [] }),
    cycles: await json<Cycles>('cycles', { symbol: [], seam: [], components: [] }),
    conversion: (await json<{ states?: Record<string, 'runtime' | 'ported'> } | null>('conversion', null))?.states ?? {},
    compatAreas: (await json<{ areas?: Record<string, string> } | null>('compat', null))?.areas ?? {},
    wordpressHistory: await json<HistoryFile | null>('wordpress-history', null),
    speedyspecHistory: await json<RuntimeHistoryFile | null>('speedyspec-history', null),
    crates: await json<CratesFile>('crates', { crates: [] }),
    examples: { files: examples, results: await json<ExamplesFile | null>('examples', null) },
    seams,
    content: await readContent(dirs.content),
    sources: (await Bun.file(dirs.sources).exists()) ? ((await Bun.file(dirs.sources).json()) as Sources) : null,
  };
}

const KINDS: Record<string, ContentKind> = { _seam: 'seam', _porting: 'porting', _architecture: 'architecture' };

async function readContent(dir: string): Promise<ContentEntry[]> {
  if (!existsSync(dir)) return [];
  const out: ContentEntry[] = [];
  for (const section of ['wordpress', 'speedyspec'] as const) {
    // A slug with a / (class/WP_Hook, filter/the_content) is a nested file.
    for await (const file of new Bun.Glob(`${section}/*/**/*.mdx`).scan({ cwd: dir })) {
      const rel = file.split(sep).join('/');
      const [, seam, ...rest] = rel.split('/') as [string, string, ...string[]];
      const slug = rest.join('/').slice(0, -'.mdx'.length);
      const text = await Bun.file(join(dir, file)).text();
      const data = frontmatter(text);
      const kind = KINDS[slug] ?? 'symbol';
      const entry: ContentEntry = { section, seam, slug, kind, data, body: text.replace(/^---\r?\n[\s\S]*?\r?\n?---\r?\n?/, ''), file: rel };
      if (typeof data.symbol === 'string') entry.symbol = data.symbol;
      out.push(entry);
    }
  }
  return out.sort((a, b) => (a.file < b.file ? -1 : 1));
}

/** The YAML between the first two `---` lines, or `{}`. */
export function frontmatter(text: string): Record<string, unknown> {
  const m = /^---\r?\n([\s\S]*?)\r?\n?---/.exec(text);
  if (!m) return {};
  return (parse(m[1] ?? '') as Record<string, unknown> | null) ?? {};
}

/** The WordPress release a seam's compat scenarios were recorded against, or null when it has no compat area. */
export function compatWordPress(seamId: string | undefined, d: Pick<GuideData, 'compatAreas'>): string | null {
  return seamId === undefined ? null : (d.compatAreas[seamId] ?? null);
}
