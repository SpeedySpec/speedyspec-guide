/**
 * What each page shows, as plain objects built from the guide's data. Components only render these. A link whose page
 * doesn't exist has `href: null`, and is shown as text.
 */
import type { GuideSymbol, Side } from '@speedyspec-guide/domain';
import type { ContentEntry, GuideData } from './data.ts';
import { indexOf } from './index-of.ts';
import { methodAnchor, symbolSlug } from './slug.ts';
import { type SpeedySpecVerdict, speedyspecProvenance, speedyspecVerdict, wordpressProvenance } from './verdict.ts';

export type Section = 'wordpress' | 'speedyspec';

export interface MemberView {
  id: string;
  kind: GuideSymbol['kind'];
  name: string;
  slug: string;
  href: string | null;
  verdict: SpeedySpecVerdict;
  circular: boolean;
  methods?: MemberView[];
}

export interface SeamView {
  id: string;
  name: string;
  job: string;
  ported: boolean;
  roles: { role: string; members: MemberView[] }[];
}

export interface Link {
  id: string;
  name: string;
  href: string | null;
  circular: boolean;
}

export interface ExampleView {
  id: string;
  name: string;
  title: string;
  code: string;
  sides: { side: Side; status: 'passed' | 'failed' | 'not-run'; detail?: string }[];
}

export interface SymbolView {
  id: string;
  kind: GuideSymbol['kind'];
  name: string;
  signature?: string;
  seam: SeamView;
  role: string;
  provenance: { wordpress: ReturnType<typeof wordpressProvenance>; speedyspec: ReturnType<typeof speedyspecProvenance> };
  verdict: ReturnType<typeof speedyspecVerdict>;
  edges: { kind: string; label: string; to: Link }[];
  callsInto: { seam: string; symbols: Link[] }[];
  fires: { id: string; name: string; href: string | null; dynamic: boolean }[];
  examples: ExampleView[];
  content: ContentEntry | null;
  methods?: SymbolView[];
}

const OUT: Record<string, string> = { reads: 'reads', writes: 'writes', calls: 'calls', runs: 'runs', 'undone-by': 'undone by', alias: 'alias of', matches: 'matches' };
const IN: Record<string, string> = { reads: 'read by', writes: 'written by', calls: 'called by', runs: 'run by', 'undone-by': 'undoes', alias: 'aliased by', matches: 'matched by' };

/** The folder under `seams/<seam>/examples/` holding a symbol's examples. */
export function exampleFolder(id: string): string {
  return symbolSlug(id).replaceAll('#', '--').replaceAll('/', '--');
}

/** The page a symbol is on in a section (its own, or its class's with an anchor for a method), or null when there is
 * none. Every link and every built page goes through this. */
export function pageOf(id: string, section: Section, d: GuideData): string | null {
  const ix = indexOf(d);
  if (id.startsWith('method:')) {
    const cls = `class:${id.slice('method:'.length, id.lastIndexOf('::'))}`;
    if (!ix.hasPage(cls, section)) return null;
    return `/${section}/${ix.seamOf(cls)}/${ix.slug(cls)}/#${methodAnchor(id).anchor}`;
  }
  return ix.hasPage(id, section) ? `/${section}/${ix.seamOf(id)}/${ix.slug(id)}/` : null;
}


function nameOf(id: string, d: GuideData): string {
  return indexOf(d).symbol(id)?.name ?? id.slice(id.indexOf(':') + 1);
}

function kindOf(id: string, d: GuideData): GuideSymbol['kind'] {
  return indexOf(d).symbol(id)?.kind ?? (id.slice(0, id.indexOf(':')) as GuideSymbol['kind']);
}

function together(a: string, b: string, d: GuideData): boolean {
  return indexOf(d).component(a)?.has(b) === true;
}

function member(id: string, section: Section, d: GuideData): MemberView {
  const view: MemberView = {
    id,
    kind: kindOf(id, d),
    name: nameOf(id, d),
    slug: indexOf(d).slug(id),
    href: pageOf(id, section, d),
    verdict: speedyspecVerdict(id, d).verdict,
    circular: indexOf(d).component(id) !== undefined,
  };
  if (view.kind === 'class') view.methods = indexOf(d).methodsOf(id).map((m) => member(m, section, d));
  return view;
}

/**
 * A seam with its members grouped by role, in seam.yaml order; members in no role go last, under "other". The
 * WordPress section shows WordPress's symbols only; the SpeedySpec section adds the runtime symbols the seam lists.
 */
export function seamView(seamId: string, section: Section, d: GuideData): SeamView {
  const ix = indexOf(d);
  const key = `seam|${seamId}|${section}`;
  const memo = ix.memo.get(key) as SeamView | undefined;
  if (memo) return memo;
  const seam = d.seams.find((s) => s.id === seamId);
  if (!seam) throw new Error(`no seam ${seamId}`);
  const ids = [...ix.wordpressMembers(seamId), ...(section === 'speedyspec' ? ix.runtimeMembers(seamId) : [])];
  const members = new Set(ids.filter((id) => !id.startsWith('method:')));
  const placed = new Set<string>();
  const roles: SeamView['roles'] = [];
  for (const [role, list] of Object.entries(seam.roles)) {
    const here = list.filter((id) => members.has(id) && !placed.has(id));
    for (const id of here) placed.add(id);
    if (here.length > 0) roles.push({ role, members: here.map((id) => member(id, section, d)) });
  }
  const rest = [...members].filter((id) => !placed.has(id));
  if (rest.length > 0) {
    roles.push({ role: 'other', members: rest.map((id) => member(id, section, d)).sort((a, b) => a.name.localeCompare(b.name)) });
  }
  const view = { id: seam.id, name: seam.name, job: seam.job, ported: seam.ported, roles };
  ix.memo.set(key, view);
  return view;
}

function link(id: string, from: string, section: Section, d: GuideData): Link {
  return { id, name: nameOf(id, d), href: pageOf(id, section, d), circular: together(from, id, d) };
}

/** Edges by endpoint, built once per data load. */
function edgesAt(d: GuideData): { from: Map<string, GuideData['graph']['edges']>; to: Map<string, GuideData['graph']['edges']> } {
  const ix = indexOf(d);
  const hit = ix.memo.get('edges') as ReturnType<typeof edgesAt> | undefined;
  if (hit) return hit;
  const from = new Map<string, GuideData['graph']['edges']>();
  const to = new Map<string, GuideData['graph']['edges']>();
  for (const e of d.graph.edges) {
    from.set(e.from, [...(from.get(e.from) ?? []), e]);
    to.set(e.to, [...(to.get(e.to) ?? []), e]);
  }
  const out = { from, to };
  ix.memo.set('edges', out);
  return out;
}

/** Everything a symbol's page shows. */
export function symbolView(id: string, section: Section, d: GuideData): SymbolView {
  const ix = indexOf(d);
  const seamId = ix.seamOf(id);
  if (!seamId) throw new Error(`${id} is in no seam`);
  const seam = d.seams.find((s) => s.id === seamId)!;
  const ownerId = id.startsWith('method:') ? `class:${id.slice('method:'.length, id.lastIndexOf('::'))}` : id;
  const role = Object.entries(seam.roles).find(([, ids]) => ids.includes(ownerId))?.[0] ?? 'other';
  const sym = section === 'speedyspec' ? (ix.runtimeSymbol(id) ?? ix.symbol(id)) : ix.symbol(id);

  const edges: SymbolView['edges'] = [];
  const seen = new Set<string>();
  const addEdge = (kind: string, label: string, other: string) => {
    const key = `${label}|${other}`;
    if (seen.has(key) || other === id) return;
    seen.add(key);
    edges.push({ kind, label, to: link(other, id, section, d) });
  };
  for (const e of seam.edges) {
    if (e.from === id) addEdge(e.kind, OUT[e.kind] ?? e.kind, e.to);
    if (e.to === id) addEdge(e.kind, IN[e.kind] ?? e.kind, e.from);
  }
  const at = edgesAt(d);
  const sameSeam = (e: { from: string; to: string }) => ix.seamOf(e.from) === seamId && ix.seamOf(e.to) === seamId;
  for (const e of at.from.get(id) ?? []) if (['reads', 'writes', 'calls', 'runs'].includes(e.kind) && sameSeam(e)) addEdge(e.kind, OUT[e.kind]!, e.to);
  for (const e of at.to.get(id) ?? []) if (['reads', 'writes', 'calls', 'runs'].includes(e.kind) && sameSeam(e)) addEdge(e.kind, IN[e.kind]!, e.from);

  const groups = new Map<string, Link[]>();
  for (const e of d.graph.crossSeam) {
    if (e.from !== id) continue;
    const name = d.seams.find((s) => s.id === e.toSeam)?.name ?? e.toSeam;
    const list = groups.get(name) ?? [];
    if (!list.some((l) => l.id === e.to)) list.push(link(e.to, id, section, d));
    groups.set(name, list);
  }

  const fires = (at.from.get(id) ?? [])
    .filter((e) => e.kind === 'fires')
    .map((e) => ({ id: e.to, name: nameOf(e.to, d), href: pageOf(e.to, 'wordpress', d), dynamic: ix.symbol(e.to)?.dynamic === true }));

  const folder = exampleFolder(id);
  const examples: ExampleView[] = d.examples.files
    .filter((e) => e.seam === seamId && e.symbol === folder)
    // A porting pair reads before, then after.
    .sort((a, b) => (order(a.name) < order(b.name) ? -1 : order(a.name) > order(b.name) ? 1 : 0))
    .map((e) => {
      const { title, code } = splitTitle(e.code);
      return {
        id: e.id,
        name: e.name,
        title: title ?? e.name,
        code,
        sides: e.sides.map((side) => {
          const r = d.examples.results?.results.find((x) => x.id === e.id && x.side === side);
          if (!r) return { side, status: 'not-run' as const };
          return r.passed ? { side, status: 'passed' as const } : { side, status: 'failed' as const, detail: difference(r.expected, r.actual) };
        }),
      };
    });

  const view: SymbolView = {
    id,
    kind: sym?.kind ?? kindOf(id, d),
    name: nameOf(id, d),
    ...(sym?.signature ? { signature: sym.signature } : {}),
    seam: seamView(seamId, section, d),
    role,
    provenance: { wordpress: wordpressProvenance(id, d), speedyspec: speedyspecProvenance(id, d) },
    verdict: speedyspecVerdict(id, d),
    edges,
    callsInto: [...groups].map(([seamName, symbols]) => ({ seam: seamName, symbols })),
    fires,
    examples,
    content: ix.content(section, id),
  };
  if (view.kind === 'class') view.methods = ix.methodsOf(id).map((m) => symbolView(m, section, d));
  return view;
}

/** What differed between an expected and an actual outcome, field by field. */
function difference(expected: { output: string; return: string | null; error: string | null }, actual: { output: string; return: string | null; error: string | null }): string {
  const parts: string[] = [];
  for (const field of ['return', 'error', 'output'] as const) {
    if (expected[field] !== actual[field]) parts.push(`expected ${field} ${JSON.stringify(expected[field])}, got ${JSON.stringify(actual[field])}`);
  }
  return parts.join('; ');
}

/** An example's heading (its first `//` comment line after `<?php`) and its code without the tag or that line. */
function splitTitle(source: string): { title?: string; code: string } {
  const lines = source.replace(/^<\?php\s*\n/, '').split('\n');
  const first = lines[0]?.match(/^\/\/\s*(.+)$/);
  return first ? { title: first[1]!.trim(), code: lines.slice(1).join('\n') } : { code: lines.join('\n') };
}

/** Sort key for an example: "-after" sorts after its "-before". */
function order(name: string): string {
  return name.replace(/-after$/, '-~after');
}
