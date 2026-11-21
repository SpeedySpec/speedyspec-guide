/**
 * What each page shows, as plain objects built from the guide's data. Components only render these.
 */
import type { GuideSymbol, Side } from '@speedyspec-guide/domain';
import type { ContentEntry, GuideData } from './data.ts';
import { methodAnchor, symbolSlug } from './slug.ts';
import { type SpeedySpecVerdict, speedyspecProvenance, speedyspecVerdict, wordpressProvenance } from './verdict.ts';

export type Section = 'wordpress' | 'speedyspec';

export interface MemberView {
  id: string;
  kind: GuideSymbol['kind'];
  name: string;
  slug: string;
  href: string;
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
  href: string;
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
  fires: { id: string; name: string; href: string; dynamic: boolean }[];
  examples: ExampleView[];
  content: ContentEntry | null;
  methods?: SymbolView[];
}

const OUT: Record<string, string> = { reads: 'reads', writes: 'writes', calls: 'calls', runs: 'runs', 'undone-by': 'undone by', alias: 'alias of', matches: 'matches' };
const IN: Record<string, string> = { reads: 'read by', writes: 'written by', calls: 'called by', runs: 'run by', 'undone-by': 'undoes', alias: 'alias of', matches: 'matched by' };

/** The folder under `seams/<seam>/examples/` holding a symbol's examples. */
export function exampleFolder(id: string): string {
  return symbolSlug(id).replaceAll('#', '--').replaceAll('/', '--');
}

/** The page a symbol is on, in a section: its own, or its class's with an anchor for a method. */
export function hrefOf(id: string, section: Section, d: GuideData): string {
  const seam = d.assignment.seamOf[id] ?? 'unassigned';
  if (id.startsWith('method:')) {
    const { page, anchor } = methodAnchor(id);
    return `/${section}/${seam}/${page}/#${anchor}`;
  }
  return `/${section}/${seam}/${symbolSlug(id)}/`;
}

function symbolOf(id: string, d: GuideData): GuideSymbol | undefined {
  return d.inventory.symbols.find((s) => s.id === id) ?? d.runtime.find((s) => s.id === id);
}

function nameOf(id: string, d: GuideData): string {
  return symbolOf(id, d)?.name ?? id.slice(id.indexOf(':') + 1);
}

function isCircular(id: string, d: GuideData): boolean {
  return d.cycles.components.some((c) => c.includes(id));
}

function together(a: string, b: string, d: GuideData): boolean {
  return d.cycles.components.some((c) => c.includes(a) && c.includes(b));
}

function member(id: string, section: Section, d: GuideData): MemberView {
  const sym = symbolOf(id, d);
  const view: MemberView = {
    id,
    kind: sym?.kind ?? (id.slice(0, id.indexOf(':')) as GuideSymbol['kind']),
    name: nameOf(id, d),
    slug: symbolSlug(id),
    href: hrefOf(id, section, d),
    verdict: speedyspecVerdict(id, d).verdict,
    circular: isCircular(id, d),
  };
  if (view.kind === 'class') {
    const prefix = `method:${id.slice('class:'.length)}::`;
    view.methods = membersOf(d.assignment.seamOf[id] ?? '', d)
      .filter((m) => m.startsWith(prefix))
      .sort()
      .map((m) => member(m, section, d));
  }
  return view;
}

function membersOf(seamId: string, d: GuideData): string[] {
  return Object.entries(d.assignment.seamOf)
    .filter(([, s]) => s === seamId)
    .map(([id]) => id);
}

/** A seam with its members grouped by role, in seam.yaml order; members in no role go last, under "other". */
export function seamView(seamId: string, section: Section, d: GuideData): SeamView {
  const seam = d.seams.find((s) => s.id === seamId);
  if (!seam) throw new Error(`no seam ${seamId}`);
  const members = new Set(membersOf(seamId, d).filter((id) => !id.startsWith('method:')));
  const placed = new Set<string>();
  const roles: SeamView['roles'] = [];
  for (const [role, ids] of Object.entries(seam.roles)) {
    const here = ids.filter((id) => members.has(id) && !placed.has(id));
    for (const id of here) placed.add(id);
    if (here.length > 0) roles.push({ role, members: here.map((id) => member(id, section, d)) });
  }
  const rest = [...members].filter((id) => !placed.has(id));
  if (rest.length > 0) {
    roles.push({ role: 'other', members: rest.map((id) => member(id, section, d)).sort((a, b) => a.name.localeCompare(b.name)) });
  }
  return { id: seam.id, name: seam.name, job: seam.job, ported: seam.ported, roles };
}

function link(id: string, from: string, section: Section, d: GuideData): Link {
  return { id, name: nameOf(id, d), href: hrefOf(id, section, d), circular: together(from, id, d) };
}

/** Everything a symbol's page shows. */
export function symbolView(id: string, section: Section, d: GuideData): SymbolView {
  const sym = symbolOf(id, d);
  const seamId = d.assignment.seamOf[id];
  if (!seamId) throw new Error(`${id} is in no seam`);
  const seam = d.seams.find((s) => s.id === seamId)!;
  const ownerId = id.startsWith('method:') ? `class:${id.slice('method:'.length, id.lastIndexOf('::'))}` : id;
  const role = Object.entries(seam.roles).find(([, ids]) => ids.includes(ownerId))?.[0] ?? 'other';

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
  for (const e of d.graph.edges) {
    if (!['reads', 'writes', 'calls', 'runs'].includes(e.kind)) continue;
    if (d.assignment.seamOf[e.from] !== seamId || d.assignment.seamOf[e.to] !== seamId) continue;
    if (e.from === id) addEdge(e.kind, OUT[e.kind]!, e.to);
    if (e.to === id) addEdge(e.kind, IN[e.kind]!, e.from);
  }

  const groups = new Map<string, Link[]>();
  for (const e of d.graph.crossSeam) {
    if (e.from !== id) continue;
    const name = d.seams.find((s) => s.id === e.toSeam)?.name ?? e.toSeam;
    const list = groups.get(name) ?? [];
    if (!list.some((l) => l.id === e.to)) list.push(link(e.to, id, section, d));
    groups.set(name, list);
  }

  const fires = d.graph.edges
    .filter((e) => e.from === id && e.kind === 'fires')
    .map((e) => ({ id: e.to, name: nameOf(e.to, d), href: hrefOf(e.to, section === 'speedyspec' ? 'wordpress' : section, d), dynamic: symbolOf(e.to, d)?.dynamic === true }));

  const folder = exampleFolder(id);
  const examples: ExampleView[] = d.examples.files
    .filter((e) => e.seam === seamId && e.symbol === folder)
    .sort((a, b) => a.name.localeCompare(b.name))
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
          return r.passed ? { side, status: 'passed' as const } : { side, status: 'failed' as const, detail: `expected ${r.expected.return ?? r.expected.error}, got ${r.actual.return ?? r.actual.error}` };
        }),
      };
    });

  const view: SymbolView = {
    id,
    kind: sym?.kind ?? (id.slice(0, id.indexOf(':')) as GuideSymbol['kind']),
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
    content: d.content.find((c) => c.section === section && c.kind === 'symbol' && c.symbol === id) ?? null,
  };
  if (view.kind === 'class') {
    const prefix = `method:${id.slice('class:'.length)}::`;
    view.methods = membersOf(seamId, d).filter((m) => m.startsWith(prefix)).sort().map((m) => symbolView(m, section, d));
  }
  return view;
}

/** An example's heading (its first `//` comment line after `<?php`) and its code without the tag or that line. */
function splitTitle(source: string): { title?: string; code: string } {
  const lines = source.replace(/^<\?php\s*\n/, '').split('\n');
  const first = lines[0]?.match(/^\/\/\s*(.+)$/);
  return first ? { title: first[1]!.trim(), code: lines.slice(1).join('\n') } : { code: lines.join('\n') };
}
