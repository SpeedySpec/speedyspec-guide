/**
 * Everything the site shows, loaded once: generated JSON, the seam map, example files and the MDX content.
 * The only module of the site that reads files.
 */
import { ExampleFiles } from '@speedyspec-guide/adapter-example-files';
import { SeamFiles } from '@speedyspec-guide/adapter-seam-files';
import type { Cycles, ExamplesFile, Graph, HistoryFile, RuntimeHistoryFile } from '@speedyspec-guide/app';
import type { Assignment, Example, ForkVerdict, GuideSymbol, Inventory, Seam } from '@speedyspec-guide/domain';
import { existsSync } from 'node:fs';
import { join, sep } from 'node:path';
import { parse } from 'yaml';

/** `generated/crates.json`: the server's crates and their dependencies on each other. */
export interface CratesFile {
  crates: { name: string; dependencies: string[] }[];
}

export type ContentKind = 'symbol' | 'seam' | 'porting' | 'architecture';

/** One MDX file under content/: `<section>/<seam>/<slug>.mdx`. */
export interface ContentEntry {
  section: 'wordpress' | 'speedyspec';
  seam: string;
  slug: string;
  kind: ContentKind;
  symbol?: string;
  data: Record<string, unknown>;
  /** The path relative to the content folder, as the content collection names it. */
  file: string;
}

export interface GuideData {
  inventory: Inventory;
  runtime: GuideSymbol[];
  assignment: Assignment;
  graph: Graph;
  cycles: Cycles;
  fork: Record<string, ForkVerdict>;
  wordpressHistory: HistoryFile | null;
  speedyspecHistory: RuntimeHistoryFile | null;
  crates: CratesFile;
  examples: { files: Example[]; results: ExamplesFile | null };
  seams: Seam[];
  content: ContentEntry[];
}

const root = join(import.meta.dir, '..', '..', '..');

export function guideDirs(env: Record<string, string | undefined> = process.env) {
  return {
    data: env.GUIDE_DATA_DIR ?? join(root, 'generated'),
    seams: env.GUIDE_SEAMS_DIR ?? join(root, 'seams'),
    content: env.GUIDE_CONTENT_DIR ?? join(root, 'content'),
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
  const seams = existsSync(dirs.seams) ? await new SeamFiles(dirs.seams).all() : [];
  const examples = seams.length > 0 ? (await new ExampleFiles(dirs.seams, seams).all()).examples : [];
  return {
    inventory: await json<Inventory>('inventory-wp', { base: 'wp', version: '', symbols: [], edges: [], unresolved: [] }),
    runtime: await json<GuideSymbol[]>('inventory-runtime', []),
    assignment: await json<Assignment>('assignment', { seamOf: {}, unassigned: [], conflicts: [] }),
    graph: await json<Graph>('graph', { nodes: [], edges: [], crossSeam: [] }),
    cycles: await json<Cycles>('cycles', { symbol: [], seam: [], components: [] }),
    fork: await json<Record<string, ForkVerdict>>('fork', {}),
    wordpressHistory: await json<HistoryFile | null>('wordpress-history', null),
    speedyspecHistory: await json<RuntimeHistoryFile | null>('speedyspec-history', null),
    crates: await json<CratesFile>('crates', { crates: [] }),
    examples: { files: examples, results: await json<ExamplesFile | null>('examples', null) },
    seams,
    content: await readContent(dirs.content),
  };
}

const KINDS: Record<string, ContentKind> = { _seam: 'seam', _porting: 'porting', _architecture: 'architecture' };

async function readContent(dir: string): Promise<ContentEntry[]> {
  if (!existsSync(dir)) return [];
  const out: ContentEntry[] = [];
  for (const section of ['wordpress', 'speedyspec'] as const) {
    for await (const file of new Bun.Glob(`${section}/*/*.mdx`).scan({ cwd: dir })) {
      const rel = file.split(sep).join('/');
      const [, seam, name] = rel.split('/') as [string, string, string];
      const slug = name.slice(0, -'.mdx'.length);
      const data = frontmatter(await Bun.file(join(dir, file)).text());
      const kind = KINDS[slug] ?? 'symbol';
      const entry: ContentEntry = { section, seam, slug, kind, data, file: rel };
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
