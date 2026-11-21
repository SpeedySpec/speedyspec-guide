/** The Rust-or-PHP page: for each seam, which of its WordPress symbols SpeedySpec has converted to Rust. */
import type { GuideData } from './data.ts';
import { pageOf } from './views.ts';

type State = 'runtime' | 'ported' | 'php';

/** What each state is called on the page. */
export const STATE_LABELS: Record<State, string> = {
  runtime: 'Rust, in the runtime',
  ported: 'Rust, not in the runtime yet',
  php: 'PHP',
};

/** The kinds that get a state: hooks and globals follow from the functions that fire or hold them. */
const KINDS = new Set(['function', 'class', 'method', 'constant']);

export interface ConversionRow {
  seam: string;
  name: string;
  runtime: number;
  ported: number;
  php: number;
  /** Its symbols by state, in the order runtime, ported, PHP; a state with none is left out. */
  groups: { state: State; label: string; members: { id: string; name: string; href: string | null }[] }[];
}

/** Every WordPress seam with any Rust, in full, and every seam wholly in PHP, with its count. */
export function conversionView(d: GuideData): { withRust: ConversionRow[]; phpOnly: { seam: string; name: string; php: number }[] } {
  const bySeam = new Map<string, string[]>();
  for (const [id, seam] of Object.entries(d.assignment.seamOf)) {
    if (!KINDS.has(id.slice(0, id.indexOf(':')))) continue;
    bySeam.set(seam, [...(bySeam.get(seam) ?? []), id]);
  }
  const withRust: ConversionRow[] = [];
  const phpOnly: { seam: string; name: string; php: number }[] = [];
  for (const seam of d.seams) {
    const ids = (bySeam.get(seam.id) ?? []).sort();
    if (ids.length === 0) continue;
    const stateOf = (id: string): State => d.conversion[id] ?? 'php';
    const of = (state: State) => ids.filter((id) => stateOf(id) === state);
    const [runtime, ported, php] = [of('runtime'), of('ported'), of('php')];
    if (runtime.length + ported.length === 0) {
      phpOnly.push({ seam: seam.id, name: seam.name, php: php.length });
      continue;
    }
    const groups = (['runtime', 'ported', 'php'] as const)
      .map((state) => ({ state, label: STATE_LABELS[state], members: of(state).map((id) => ({ id, name: id.slice(id.indexOf(':') + 1), href: pageOf(id, 'wordpress', d) })) }))
      .filter((g) => g.members.length > 0);
    withRust.push({ seam: seam.id, name: seam.name, runtime: runtime.length, ported: ported.length, php: php.length, groups });
  }
  return { withRust, phpOnly };
}
