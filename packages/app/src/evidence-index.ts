/** Which compat scenarios and breaks exercise which symbol, from an area's catalogue. */

import { hookPattern } from './hook-pattern.ts';

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

/** The Hook API calls whose first argument names a hook. */
const HOOKING = ['add_filter', 'add_action', 'has_filter', 'has_action', 'remove_filter', 'remove_action'];

/**
 * The hooks a step's hook name matches, keeping only the most specific: `pre_option_blogname` matches
 * `pre_option_{$option}`, not `pre_{$field}`, and `update_option` matches the literal hook, not `{$old}_{$new}`. A
 * name that is only a placeholder (`{$hook_name}`) matches nothing.
 */
function hookedBy(step: { call: string; args?: unknown[] }, hooks: { id: string; pattern: RegExp; literal: number }[]): string[] {
  const name = step.args?.[0];
  if (!HOOKING.includes(step.call) || typeof name !== 'string') return [];
  const matches = hooks.filter((h) => h.pattern.test(name));
  const best = Math.max(...matches.map((h) => h.literal));
  return matches.filter((h) => h.literal === best).map((h) => h.id);
}

/**
 * The index of one area. `hooks` are the inventory's filters and actions: a step hooking a name also counts for the
 * hook it matches, so a hook's page can cite the scenarios that register on it.
 */
export function buildEvidenceIndex(area: string, catalogue: Catalogue, hooks: { id: string; name: string }[] = []): EvidenceIndex {
  const index: EvidenceIndex = {};
  const entry = (id: string) => (index[id] ??= { scenarios: [], breaks: [] });
  const symbolsOf = new Map<string, string[]>();
  const patterns = hooks
    .map((h) => ({ id: h.id, pattern: hookPattern(h.name), literal: h.name.replace(/\{\$[^}]*\}/g, '').length }))
    .filter((h) => h.literal > 0);
  for (const s of catalogue.scenarios) {
    const ids = s.steps.map((step) => stepSymbol(area, step));
    symbolsOf.set(s.name, ids.map((id) => id ?? ''));
    for (const id of new Set([...ids, ...s.steps.flatMap((step) => hookedBy(step, patterns))])) {
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
