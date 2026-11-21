/**
 * Mermaid text for the site's diagrams, generated from the guide's data so a diagram only ever shows what the
 * citations back. Circular dependencies are red and labelled; links through hooks are dashed.
 */
import type { Seam } from '@speedyspec-guide/domain';
import type { CratesFile, GuideData } from './data.ts';
import type { SeamView } from './views.ts';

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
export function seamDiagram(view: SeamView, d: GuideData): string {
  const members = view.roles.flatMap((r) => r.members).filter((m) => m.kind === 'function' || m.kind === 'class' || m.kind === 'global' || m.kind === 'constant');
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

  for (const e of [...seam.edges, ...d.graph.edges]) {
    const label = labels[e.kind];
    const a = node.get(e.from);
    const b = node.get(e.to);
    if (label && a && b && a !== b) add(a, b, label, false, [e.from, e.to]);
  }

  // Through hooks: a member fires a hook that runs another member.
  for (const fire of d.graph.edges.filter((e) => e.kind === 'fires' && node.has(e.from))) {
    for (const run of d.graph.edges.filter((e) => e.kind === 'runs' && e.from === fire.to && node.has(e.to))) {
      const hook = fire.to.slice(fire.to.indexOf(':') + 1);
      add(node.get(fire.from)!, node.get(run.to)!, `via ${hook}`, true, [fire.from, run.to]);
    }
  }

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
  for (const c of counted.values()) links.push({ ...c, label: `${c.kind} ${c.count}` });

  links.forEach((l) => lines.push(`  ${l.from} ${l.dashed ? '-.->' : '-->'}|${escapeLabel(l.label)}| ${l.to}`));

  // Cycle edges: a link whose symbol pair is a step of a listed cycle path.
  const steps = new Set(d.cycles.symbol.flatMap((c) => c.path.slice(1).map((to, i) => `${c.path[i]}|${to}`)));
  links.forEach((l, i) => {
    if (l.pairs.some(([a, b]) => steps.has(`${a}|${b}`))) lines.push(`  linkStyle ${i} stroke:${RED},stroke-width:2px`);
  });
  lines.push(`  ${CYCLE_CLASS}`);
  return lines.join('\n');
}

/** A seam's WordPress packages and SpeedySpec crates, and the dependencies between those crates. */
export function architectureDiagram(seam: Seam, crates: CratesFile): string {
  const lines = ['flowchart TB'];
  const ids = new Map<string, string>();
  const add = (name: string, shape: (label: string) => string) => {
    const id = `n${ids.size}`;
    ids.set(name, id);
    lines.push(`  ${id}${shape(escapeLabel(name))}`);
  };
  for (const p of seam.packages ?? []) add(p, (l) => `[/${l}/]`);
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
