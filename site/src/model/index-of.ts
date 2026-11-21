/**
 * Lookups over the guide's data, built once per load: symbols by id, seams, circular groups, content, which pages
 * exist and their slugs, and memoised seam views. Every "is there a page for this?" question is answered here, so
 * page paths and links can't disagree.
 */
import type { GuideSymbol } from '@speedyspec-guide/domain';
import type { ContentEntry, GuideData } from './data.ts';
import { uniqueSlugs } from './slug.ts';

export interface GuideIndex {
  symbol(id: string): GuideSymbol | undefined;
  /** The runtime's own declaration, for SpeedySpec pages. */
  runtimeSymbol(id: string): GuideSymbol | undefined;
  /** The seam of a WordPress symbol, or of a runtime symbol a seam lists. */
  seamOf(id: string): string | undefined;
  /** WordPress symbols assigned to the seam, methods included. */
  wordpressMembers(seamId: string): string[];
  /** Runtime-only symbols the seam lists. */
  runtimeMembers(seamId: string): string[];
  /** A class's methods; the SpeedySpec section adds the methods the runtime adds to it. */
  methodsOf(classId: string, section?: 'wordpress' | 'speedyspec'): string[];
  component(id: string): Set<string> | undefined;
  content(section: 'wordpress' | 'speedyspec', id: string): ContentEntry | null;
  hasPage(id: string, section: 'wordpress' | 'speedyspec'): boolean;
  pageIds(section: 'wordpress' | 'speedyspec'): string[];
  slug(id: string): string;
  /** Graph edges by endpoint. */
  edgesFrom(id: string): GuideData['graph']['edges'];
  edgesTo(id: string): GuideData['graph']['edges'];
  /** Cross-seam edges leaving a symbol. */
  crossSeamFrom(id: string): GuideData['graph']['crossSeam'];
  /** False when SpeedySpec's packages/ tree doesn't carry the seam's code. */
  inFork(seamId: string): boolean;
  /** Memo for views built from this data. */
  memo: Map<string, unknown>;
}

const cache = new WeakMap<GuideData, GuideIndex>();

function push<K, V>(map: Map<K, V[]>, key: K, value: V): void {
  const list = map.get(key);
  if (list) list.push(value);
  else map.set(key, [value]);
}

export function indexOf(d: GuideData): GuideIndex {
  const hit = cache.get(d);
  if (hit) return hit;

  const symbols = new Map<string, GuideSymbol>();
  for (const s of d.inventory.symbols) symbols.set(s.id, s);
  const runtime = new Map<string, GuideSymbol>(d.runtime.map((s) => [s.id, s]));
  const seams = new Set(d.seams.map((s) => s.id));

  const wordpressMembers = new Map<string, string[]>();
  const methods = new Map<string, string[]>();
  for (const [id, seam] of Object.entries(d.assignment.seamOf)) {
    push(wordpressMembers, seam, id);
    if (id.startsWith('method:')) {
      const cls = `class:${id.slice('method:'.length, id.lastIndexOf('::'))}`;
      push(methods, cls, id);
    }
  }
  for (const list of methods.values()) list.sort();
  const runtimeMembers = new Map<string, string[]>();
  const runtimeMethods = new Map<string, string[]>();
  for (const [id, seam] of Object.entries(d.runtimeSeamOf)) {
    push(runtimeMembers, seam, id);
    // A method the runtime adds to a class is listed with the class's methods.
    if (id.startsWith('method:') && !symbols.has(id)) push(runtimeMethods, `class:${id.slice('method:'.length, id.lastIndexOf('::'))}`, id);
  }
  for (const list of runtimeMethods.values()) list.sort();

  const component = new Map<string, Set<string>>();
  for (const c of d.cycles.components) {
    const set = new Set(c);
    for (const id of c) component.set(id, set);
  }

  const content = new Map<string, ContentEntry>();
  for (const c of d.content) if (c.kind === 'symbol' && c.symbol) content.set(`${c.section}|${c.symbol}`, c);

  const outsideFork = new Set<string>();
  const by = <T extends { from: string; to: string }>(list: T[], key: 'from' | 'to') => {
    const out = new Map<string, T[]>();
    for (const e of list) {
      const k = e[key];
      const bucket = out.get(k);
      if (bucket) bucket.push(e);
      else out.set(k, [e]);
    }
    return out;
  };
  const edgesFrom = by(d.graph.edges, 'from');
  const edgesTo = by(d.graph.edges, 'to');
  const crossFrom = by(d.graph.crossSeam, 'from');

  const wordpressPages = new Set<string>();
  const speedyspecPages = new Set<string>();
  for (const [id, seam] of Object.entries(d.assignment.seamOf)) {
    if (id.startsWith('method:') || !seams.has(seam) || !symbols.has(id)) continue;
    wordpressPages.add(id);
    const forked = !outsideFork.has(seam) && (d.fork[id] === 'modified' || d.fork[id] === 'removed');
    if (content.has(`speedyspec|${id}`) || forked) speedyspecPages.add(id);
  }
  for (const [id, seam] of Object.entries(d.runtimeSeamOf)) if (seams.has(seam) && !symbols.has(id) && !id.startsWith('method:')) speedyspecPages.add(id);

  const slugs = uniqueSlugs([...wordpressPages, ...speedyspecPages]);

  const index: GuideIndex = {
    symbol: (id) => symbols.get(id) ?? runtime.get(id),
    runtimeSymbol: (id) => runtime.get(id),
    seamOf: (id) => d.assignment.seamOf[id] ?? d.runtimeSeamOf[id],
    wordpressMembers: (seam) => wordpressMembers.get(seam) ?? [],
    runtimeMembers: (seam) => runtimeMembers.get(seam) ?? [],
    methodsOf: (cls, section = 'wordpress') => [...(methods.get(cls) ?? []), ...(section === 'speedyspec' ? (runtimeMethods.get(cls) ?? []) : [])],
    component: (id) => component.get(id),
    content: (section, id) => content.get(`${section}|${id}`) ?? null,
    hasPage: (id, section) => (section === 'wordpress' ? wordpressPages : speedyspecPages).has(id),
    pageIds: (section) => [...(section === 'wordpress' ? wordpressPages : speedyspecPages)].sort(),
    slug: (id) => slugs.get(id) ?? uniqueSlugs([id]).get(id)!,
    edgesFrom: (id) => edgesFrom.get(id) ?? [],
    edgesTo: (id) => edgesTo.get(id) ?? [],
    crossSeamFrom: (id) => crossFrom.get(id) ?? [],
    inFork: (seamId) => !outsideFork.has(seamId),
    memo: new Map(),
  };
  cache.set(d, index);
  return index;
}
