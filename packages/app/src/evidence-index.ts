/** Which compat scenarios and breaks exercise which symbol, from an area's catalogue. */

export interface Catalogue {
  scenarios: { name: string; steps: { call: string; args?: unknown[] }[] }[];
  breaks: { scenario: string; step?: number; why: string }[];
}

export interface EvidenceIndex {
  [symbolId: string]: { scenarios: string[]; breaks: { scenario: string; step?: number; why: string }[] };
}

/**
 * The symbol a scenario step calls: `add_filter` is a function; `$h->m` (a kept value; in the hooks area always a
 * `WP_Hook`) and `WP_Hook::m` are methods; `new WP_Hook` is the class; `global:<op>` names the global in its first
 * argument.
 */
export function stepSymbol(area: string, step: { call: string; args?: unknown[] }): string | null {
  const call = step.call;
  if (call.startsWith('global:')) return typeof step.args?.[0] === 'string' ? `global:${step.args[0]}` : null;
  if (call.startsWith('new ')) return `class:${call.slice(4).trim()}`;
  if (call.startsWith('$')) {
    const method = call.slice(call.indexOf('->') + 2);
    return area === 'hooks' ? `method:WP_Hook::${method}` : null;
  }
  if (call.includes('::')) return `method:${call}`;
  return `function:${call}`;
}

export function buildEvidenceIndex(area: string, catalogue: Catalogue): EvidenceIndex {
  const index: EvidenceIndex = {};
  const entry = (id: string) => (index[id] ??= { scenarios: [], breaks: [] });
  const symbolsOf = new Map<string, string[]>();
  for (const s of catalogue.scenarios) {
    const ids = s.steps.map((step) => stepSymbol(area, step));
    symbolsOf.set(s.name, ids.map((id) => id ?? ''));
    for (const id of new Set(ids)) {
      if (id && !entry(id).scenarios.includes(s.name)) entry(id).scenarios.push(s.name);
    }
  }
  for (const b of catalogue.breaks) {
    const ids = symbolsOf.get(b.scenario) ?? [];
    const targets = b.step === undefined ? new Set(ids) : new Set([ids[b.step] ?? '']);
    for (const id of targets) if (id) entry(id).breaks.push(b);
  }
  for (const id of Object.keys(index)) index[id]!.scenarios.sort();
  return index;
}
