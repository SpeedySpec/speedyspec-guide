/** How the site words verdicts, roles, provenance and evidence links. */
import type { Citation } from '@speedyspec-guide/domain';
import type { SpeedySpecVerdict } from './verdict.ts';
import type { Section, SymbolView } from './views.ts';

const VERDICTS: Record<SpeedySpecVerdict, [string, Tone]> = {
  'works-as-wordpress': ['Works as WordPress', 'ok'],
  'works-with-differences': ['Works with differences', 'warn'],
  breaks: ['Breaks', 'bad'],
  'new-in-speedyspec': ['New in SpeedySpec', 'new'],
  'same-code': ['Same code as WordPress', 'ok'],
  modified: ['Modified in SpeedySpec', 'warn'],
  removed: ['Removed in SpeedySpec', 'bad'],
  unknown: ['Not yet compared', 'muted'],
};

export type Tone = 'ok' | 'warn' | 'bad' | 'new' | 'muted';

export const verdictLabel = (v: SpeedySpecVerdict): string => VERDICTS[v][0];
export const verdictTone = (v: SpeedySpecVerdict): Tone => VERDICTS[v][1];

export function roleLabel(role: string): string {
  const words = role.replaceAll('-', ' ');
  return words.charAt(0).toUpperCase() + words.slice(1);
}

/** The one line under a page's name saying how its facts were established and when the symbol arrived. */
export function provenanceText(view: SymbolView, section: Section): string {
  if (section === 'wordpress') {
    const p = view.provenance.wordpress;
    const tier = { verified: 'Verified against', 'read-from-source': 'Read from the source of', 'not-documented': 'Generated from' }[p.tier];
    return [`${tier} WordPress ${p.wordpress}`, p.since && `Since ${p.since}`, p.removed && `Removed in ${p.removed}`].filter(Boolean).join(' · ');
  }
  const s = view.provenance.speedyspec;
  return [`Added in SpeedySpec ${s.added}`, s.removed && `Removed in SpeedySpec ${s.removed}`, s.native ? 'Native (Rust)' : "WordPress's PHP"].filter(Boolean).join(' · ');
}

export interface Sources {
  wordpress: { version: string };
  server: { repo: string; commit: string };
  fork: { repo: string; commit: string; path: string };
}

const web = (repo: string) => repo.replace(/\.git$/, '').replace(/^git@github\.com:/, 'https://github.com/');
const lines = (from: number, to: number) => (from === to ? `#L${from}` : `#L${from}-L${to}`);

/** Where a reader can see a citation's evidence, at the pinned versions; null when there is nowhere to link. */
export function evidenceLink(c: Citation, s: Sources | null): string | null {
  if (!s) return null;
  const server = `${web(s.server.repo)}/blob/${s.server.commit}`;
  switch (c.kind) {
    case 'scenario':
      return `${server}/compat/${c.area}/scenarios.json`;
    case 'break':
      return `${server}/compat/${c.area}/breaks.json`;
    case 'test': {
      const [crate, stem] = c.path.split('::');
      return crate && stem ? `${server}/crates/${crate}/tests/${stem}.rs` : null;
    }
    case 'source':
      return c.base === 'wp'
        ? `https://github.com/WordPress/wordpress-develop/blob/${s.wordpress.version}/src/${c.file}${lines(c.from, c.to)}`
        : `${web(s.fork.repo)}/blob/${s.fork.commit}/${s.fork.path}/${c.file}${lines(c.from, c.to)}`;
  }
}
