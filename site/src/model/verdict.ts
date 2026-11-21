import type { Verdict } from '@speedyspec-guide/domain';
import type { GuideData } from './data.ts';

export type SpeedySpecVerdict = Verdict | 'same-code' | 'modified' | 'removed' | 'unknown';

export interface Difference {
  summary: string;
  break?: string;
}

function page(id: string, section: 'wordpress' | 'speedyspec', d: GuideData) {
  return d.content.find((c) => c.section === section && c.kind === 'symbol' && c.symbol === id) ?? null;
}

/** A symbol's verdict on SpeedySpec: its SpeedySpec page's, else (unported seams) the fork comparison's, else unknown. */
export function speedyspecVerdict(id: string, d: GuideData): { verdict: SpeedySpecVerdict; differences: Difference[]; source: 'page' | 'fork' | 'outside-fork' | 'none' } {
  const p = page(id, 'speedyspec', d);
  if (p && typeof p.data.verdict === 'string') {
    return { verdict: p.data.verdict as Verdict, differences: (p.data.differences as Difference[] | undefined) ?? [], source: 'page' };
  }
  const seam = d.seams.find((s) => s.id === d.assignment.seamOf[id]);
  const fork = d.fork[id];
  if (seam && seam.inFork === false && !seam.ported) return { verdict: 'unknown', differences: [], source: 'outside-fork' };
  if (seam && !seam.ported && fork && fork !== 'added') {
    return { verdict: fork === 'same' ? 'same-code' : fork, differences: [], source: 'fork' };
  }
  return { verdict: 'unknown', differences: [], source: 'none' };
}

const VERIFIED = /<Ev\s+[^>]*\b(scenario|break|test)=/;

/** How a WordPress page's facts were established, and the symbol's WordPress history. */
export function wordpressProvenance(id: string, d: GuideData): { tier: 'verified' | 'read-from-source' | 'not-documented'; wordpress: string; since?: string; removed?: string } {
  const p = page(id, 'wordpress', d);
  const tier = p === null ? 'not-documented' : VERIFIED.test(p.body) ? 'verified' : 'read-from-source';
  const history = d.wordpressHistory?.symbols[id];
  return {
    tier,
    wordpress: d.inventory.version || 'unknown',
    ...(history?.since ? { since: history.since } : {}),
    ...(history?.removed ? { removed: history.removed } : {}),
  };
}

/** A symbol's SpeedySpec history and whether the runtime registers it natively. */
export function speedyspecProvenance(id: string, d: GuideData): { added: string; removed?: string; native: boolean } {
  const history = d.speedyspecHistory?.symbols[id];
  return {
    added: history?.since ?? 'unreleased',
    ...(history?.removed ? { removed: history.removed } : {}),
    native: d.runtime.some((s) => s.id === id),
  };
}
