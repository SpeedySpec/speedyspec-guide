/**
 * Mermaid text for the site's diagrams, generated from the guide's data so a diagram only ever shows what the
 * citations back. Circular dependencies are red and labelled; links through hooks are dashed.
 */
import { indexOf } from './index-of.ts';
import type { Seam } from '@speedyspec-guide/domain';
import type { CratesFile, GuideData } from './data.ts';
import { seamCycles } from './sections.ts';
import type { SeamView } from './views.ts';

/** Past these, a diagram stops being readable and Mermaid refuses it (500 edges): the page says so instead. */
export const MAX_NODES = 150;
export const MAX_LINKS = 300;

export const RED = '#9b1c1c';
const CYCLE_CLASS = `classDef cycle fill:#fde8e8,stroke:${RED},color:#7f1d1d`;

/** A quoted Mermaid label, with the characters Mermaid would read as syntax written as entities. */
export function escapeLabel(text: string): string {
  const escaped = text
    .replaceAll('"', '#quot;')
    .replaceAll('{', '#123;')
    .replaceAll('}', '#125;')
    .replaceAll('<', '#lt;')
    .replaceAll('>', '#gt;');
  return `"${escaped}"`;
}

interface Link {
  from: string;
  to: string;
  label: string;
  dashed: boolean;
  /** The symbol pair this link stands for, for marking cycle edges. */
  pairs: [string, string][];
}

/**
 * A seam's functions, classes and globals, the links between them, and one node per other seam it depends on or is
 * depended on by.
 */
export function seamDiagram(view: SeamView, d: GuideData): string | null {
  const members = view.roles.flatMap((r) => r.members).filter((m) => m.kind === 'function' || m.kind === 'class' || m.kind === 'global' || m.kind === 'constant');
  if (members.length > MAX_NODES) return null;
  const node = new Map<string, string>();
  const lines = ['flowchart LR'];
  const inCycle = new Set(d.cycles.components.flat());

  members.forEach((m, i) => {
    const id = `n${i}`;
    node.set(m.id, id);
    const circular = inCycle.has(m.id);
    const label = escapeLabel(circular ? `${m.name} · circular` : m.name);
    lines.push(`  ${id}${m.kind === 'global' ? `([${label}])` : `[${label}]`}${circular ? ':::cycle' : ''}`);
  });

  const links: Link[] = [];
  const seam = d.seams.find((s) => s.id === view.id)!;
  const labels: Record<string, string> = { calls: 'calls', reads: 'reads', writes: 'writes', 'undone-by': 'undone by', alias: 'alias of' };
  const add = (from: string, to: string, label: string, dashed: boolean, pair: [string, string]) => {
    const existing = links.find((l) => l.from === from && l.to === to && l.label === label);
    if (existing) existing.pairs.push(pair);
    else links.push({ from, to, label, dashed, pairs: [pair] });
  };

  for (const e of [...seam.edges, ...members.flatMap((m) => indexOf(d).edgesFrom(m.id))]) {
    const label = labels[e.kind];
    const a = node.get(e.from);
    const b = node.get(e.to);
    if (label && a && b && a !== b) add(a, b, label, false, [e.from, e.to]);
  }

  // Through hooks: a member fires a hook that runs another member. One dashed link per pair, however many hooks.
  const via = new Map<string, { from: string; to: string; hooks: Set<string>; pair: [string, string] }>();
  const ix = indexOf(d);
  for (const fire of members.flatMap((m) => ix.edgesFrom(m.id)).filter((e) => e.kind === 'fires')) {
    for (const run of ix.edgesFrom(fire.to).filter((e) => e.kind === 'runs' && node.has(e.to))) {
      if (fire.from === run.to) continue;
      const key = `${fire.from}|${run.to}`;
      const v = via.get(key) ?? { from: node.get(fire.from)!, to: node.get(run.to)!, hooks: new Set<string>(), pair: [fire.from, run.to] as [string, string] };
      v.hooks.add(fire.to.slice(fire.to.indexOf(':') + 1));
      via.set(key, v);
    }
  }
  for (const v of via.values()) add(v.from, v.to, v.hooks.size === 1 ? `via ${[...v.hooks][0]}` : `via ${v.hooks.size} hooks`, true, v.pair);

  // Other seams: one node each; one counted edge per member and direction.
  const outside = new Map<string, string>();
  const outsideNode = (seamId: string): string => {
    let id = outside.get(seamId);
    if (!id) {
      id = `n${members.length + outside.size}`;
      outside.set(seamId, id);
      const name = d.seams.find((s) => s.id === seamId)?.name ?? seamId;
      const circular = d.cycles.seam.some((c) => c.includes(seamId) && c.includes(view.id));
      lines.push(`  ${id}[[${escapeLabel(circular ? `${name} · circular` : name)}]]${circular ? ':::cycle' : ''}`);
    }
    return id;
  };
  const counted = new Map<string, Link & { count: number; kind: string }>();
  for (const e of d.graph.crossSeam) {
    const out = e.fromSeam === view.id && node.has(e.from);
    const inn = e.toSeam === view.id && node.has(e.to);
    if (!out && !inn) continue;
    const from = out ? node.get(e.from)! : outsideNode(e.fromSeam);
    const to = out ? outsideNode(e.toSeam) : node.get(e.to)!;
    const key = `${from}|${to}|${e.kind}`;
    const c = counted.get(key) ?? { from, to, label: '', dashed: e.kind === 'fires' || e.kind === 'runs', pairs: [], count: 0, kind: e.kind };
    c.count++;
    c.pairs.push([e.from, e.to]);
    counted.set(key, c);
  }
  let outsideLinks = [...counted.values()];
  if (links.length + outsideLinks.length > MAX_LINKS) {
    // Too many to draw one per member: one link per other seam, direction and kind, on the member it uses most.
    const outsideIds = new Set(outside.values());
    const merged = new Map<string, Link & { count: number; kind: string; perMember: Map<string, number> }>();
    for (const c of outsideLinks) {
      const outgoing = outsideIds.has(c.to);
      const other = outgoing ? c.to : c.from;
      const member = outgoing ? c.from : c.to;
      const key = `${other}|${outgoing}|${c.kind}`;
      const m = merged.get(key) ?? { ...c, pairs: [], count: 0, perMember: new Map<string, number>() };
      m.count += c.count;
      m.pairs.push(...c.pairs);
      m.perMember.set(member, (m.perMember.get(member) ?? 0) + c.count);
      merged.set(key, m);
    }
    outsideLinks = [...merged.values()].map(({ perMember, ...m }) => {
      const top = [...perMember].sort((a, b) => b[1] - a[1] || (a[0] < b[0] ? -1 : 1))[0]![0];
      const outgoing = outsideIds.has(m.to);
      return outgoing ? { ...m, from: top } : { ...m, to: top };
    });
  }
  for (const c of outsideLinks) links.push({ ...c, label: `${c.kind} ${c.count}` });

  if (links.length > MAX_LINKS) return null;
  links.forEach((l) => lines.push(`  ${l.from} ${l.dashed ? '-.->' : '-->'}|${escapeLabel(l.label)}| ${l.to}`));

  // Cycle edges: a link whose symbol pair is a step of one of the seam's cycles (as its page lists them).
  const steps = new Set(seamCycles(view.id, d).flatMap((c) => c.path.slice(1).map((to, i) => `${c.path[i]}|${to}`)));
  links.forEach((l, i) => {
    if (l.pairs.some(([a, b]) => steps.has(`${a}|${b}`))) lines.push(`  linkStyle ${i} stroke:${RED},stroke-width:2px`);
  });
  lines.push(`  ${CYCLE_CLASS}`);
  return lines.join('\n');
}

/** A seam's SpeedySpec crates and the dependencies between them. */
export function architectureDiagram(seam: Seam, crates: CratesFile): string {
  const lines = ['flowchart TB'];
  const ids = new Map<string, string>();
  const add = (name: string, shape: (label: string) => string) => {
    const id = `n${ids.size}`;
    ids.set(name, id);
    lines.push(`  ${id}${shape(escapeLabel(name))}`);
  };
  for (const c of seam.crates ?? []) add(c, (l) => `[${l}]`);
  for (const c of crates.crates) {
    if (!ids.has(c.name)) continue;
    for (const dep of c.dependencies) {
      if (!ids.has(dep)) add(dep, (l) => `[${l}]:::outside`);
      lines.push(`  ${ids.get(c.name)} --> ${ids.get(dep)}`);
    }
  }
  lines.push('  classDef outside stroke-dasharray:4 3');
  return lines.join('\n');
}
