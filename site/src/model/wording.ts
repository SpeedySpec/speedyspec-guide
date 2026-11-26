/** How the site words verdicts, roles, provenance and evidence links. */
import type { Citation } from '@speedyspec-guide/domain';
import type { SpeedySpecVerdict } from './verdict.ts';
import type { Section, SymbolView } from './views.ts';

const VERDICTS: Record<SpeedySpecVerdict, [string, Tone]> = {
  'works-as-wordpress': ['Works as WordPress', 'ok'],
  'works-with-differences': ['Works with differences', 'warn'],
  breaks: ['Breaks', 'bad'],
  'new-in-speedyspec': ['New in SpeedySpec', 'new'],
  'not-in-speedyspec': ['Not in SpeedySpec yet', 'muted'],
  unknown: ['Not yet compared', 'muted'],
};

export type Tone = 'ok' | 'warn' | 'bad' | 'new' | 'muted';

export const verdictLabel = (v: SpeedySpecVerdict): string => VERDICTS[v][0];
export const verdictTone = (v: SpeedySpecVerdict): Tone => VERDICTS[v][1];

export function roleLabel(role: string): string {
  const words = role.replaceAll('-', ' ');
  return words.charAt(0).toUpperCase() + words.slice(1);
}

/**
 * A symbol's page title: functions and methods with parentheses, globals with their dollar sign.
 *
 * @param s
 *     The symbol's kind and name.
 * @return
 *     The title as the page shows it.
 */
export function symbolTitle(s: { kind: string; name: string }): string {
  if (s.kind === 'function' || s.kind === 'method') return `${s.name}()`;
  return s.kind === 'global' ? `$${s.name}` : s.name;
}

/** The one line under a page's name saying how its facts were established and when the symbol arrived. */
export function provenanceText(view: SymbolView, section: Section): string {
  if (section === 'wordpress') {
    const p = view.provenance.wordpress;
    const trunk = `WordPress ${p.wordpress}${p.commit ? ` (trunk ${p.commit.slice(0, 7)})` : ''}`;
    const where = p.tier === 'verified' ? `Verified against WordPress ${p.compat ?? p.wordpress}` : p.tier === 'read-from-source' ? `Read from ${trunk}` : `Generated from ${trunk}`;
    const when = p.released ? p.since && `Since ${p.since}` : 'Not in a WordPress release yet';
    return [where, when, p.removed && `Removed in ${p.removed}`].filter(Boolean).join(' · ');
  }
  const s = view.provenance.speedyspec;
  if (view.verdict.verdict === 'not-in-speedyspec') return 'Not in SpeedySpec yet';
  return [`Added in SpeedySpec ${s.added}`, s.removed && `Removed in SpeedySpec ${s.removed}`, s.native ? 'Native (Rust)' : "WordPress's PHP"].filter(Boolean).join(' · ');
}

export interface Sources {
  wordpress: { version: string; commit: string };
  server: { repo: string; commit: string };
  /** speedyspec-platform, which holds the shared crates and compat areas speedyspec-server takes from crates.io. */
  platform?: { repo: string; commit: string };
}

/** The crates and compat areas in speedyspec-platform rather than speedyspec-server (generated/compat.json). */
export interface PlatformPaths {
  crates: string[];
  compat: string[];
}

const web = (repo: string) => repo.replace(/\.git$/, '').replace(/^git@github\.com:/, 'https://github.com/');
const lines = (from: number, to: number) => (from === to ? `#L${from}` : `#L${from}-L${to}`);

/** Where a reader can see a citation's evidence, at the pinned versions; null when there is nowhere to link. */
export function evidenceLink(c: Citation, s: Sources | null, moved: PlatformPaths = { crates: [], compat: [] }): string | null {
  if (!s) return null;
  const server = `${web(s.server.repo)}/blob/${s.server.commit}`;
  const platform = s.platform ? `${web(s.platform.repo)}/blob/${s.platform.commit}` : server;
  // A crate or compat area that moved to speedyspec-platform is linked there.
  const crate = (name: string) => (moved.crates.includes(name) ? platform : server);
  const area = (name: string) => (moved.compat.includes(name) ? platform : server);
  switch (c.kind) {
    case 'scenario':
      return `${area(c.area)}/compat/${c.area}/scenarios.json`;
    case 'break':
      return `${area(c.area)}/compat/${c.area}/breaks.json`;
    case 'example':
      return null;
    case 'test': {
      const [name, stem] = c.path.split('::');
      return name && stem ? `${crate(name)}/crates/${name}/tests/${stem}.rs` : null;
    }
    case 'source': {
      if (c.base === 'wp') return `https://github.com/WordPress/wordpress-develop/blob/${s.wordpress.commit}/src/${c.file}${lines(c.from, c.to)}`;
      const [top, name] = c.file.split('/');
      const repo = top === 'crates' && name ? crate(name) : top === 'compat' && name ? area(name) : server;
      return `${repo}/${c.file}${lines(c.from, c.to)}`;
    }
  }
}

/** What a SpeedySpec page without hand-written content says, by where its verdict came from. */
export function notDocumentedText(source: 'page' | 'seam' | 'none', _wordpress: string): string {
  if (source === 'seam') return 'Not in SpeedySpec yet: SpeedySpec provides this when its seam is ported.';
  if (source === 'none') return 'Not yet documented, and not yet compared with WordPress.';
  return 'Not yet documented.';
}

/** The `<Ev>` attributes that write a citation back out. */
export function citationAttrs(c: Citation): Record<string, string> {
  switch (c.kind) {
    case 'source':
      return { source: `${c.base}:${c.file}#L${c.from}${c.to === c.from ? '' : `-L${c.to}`}`, ...(c.hash ? { hash: c.hash } : {}) };
    case 'scenario':
      return { scenario: c.name, area: c.area };
    case 'break':
      return { break: c.scenario, area: c.area, ...(c.step === undefined ? {} : { step: String(c.step) }) };
    case 'test':
      return { test: c.path };
    case 'example':
      return { example: c.id };
  }
}
