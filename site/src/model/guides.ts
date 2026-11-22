/** What the developer guide pages show: the tracks in reading order, their URLs, and embedded examples and links. */
import type { Guide, Side } from '@speedyspec-guide/domain';
import type { GuideData } from './data.ts';
import { exampleView, pageOf } from './views.ts';

export interface GuideTracks {
  path: Guide[];
  topics: Guide[];
  contributing: { wordpress: Guide[]; speedyspec: Guide[] };
}

const byOrder = (a: Guide, b: Guide) => (a.order ?? 0) - (b.order ?? 0) || (a.slug < b.slug ? -1 : a.slug > b.slug ? 1 : 0);

/** The guides by track: the learning path and each contributing part by number, then slug; topics by title. */
export function guideTracks(d: Pick<GuideData, 'guides'>): GuideTracks {
  const of = (kind: Guide['kind'], part?: Guide['part']) => d.guides.filter((g) => g.kind === kind && (part === undefined || g.part === part));
  return {
    path: of('path').sort(byOrder),
    topics: of('topic').sort((a, b) => (a.title < b.title ? -1 : a.title > b.title ? 1 : 0)),
    contributing: { wordpress: of('contributing', 'wordpress').sort(byOrder), speedyspec: of('contributing', 'speedyspec').sort(byOrder) },
  };
}

/** A guide's URL. */
export function guidePath(g: Guide): string {
  if (g.kind === 'topic') return `/guides/topics/${g.seam}/`;
  if (g.kind === 'contributing') return `/guides/contributing/${g.part}/${g.slug}/`;
  return `/guides/path/${g.slug}/`;
}

/** The guides before and after one in its track, for previous and next links. */
export function neighbours(g: Guide, d: Pick<GuideData, 'guides'>): { prev: Guide | null; next: Guide | null } {
  const t = guideTracks(d);
  const track = g.kind === 'path' ? t.path : g.kind === 'contributing' ? t.contributing[g.part!] : [];
  const i = track.findIndex((x) => x.file === g.file);
  return { prev: i > 0 ? track[i - 1]! : null, next: i >= 0 && i < track.length - 1 ? track[i + 1]! : null };
}

/** The WordPress reference page of a symbol id (a method's is its class's, with an anchor), or null when it has none. */
export function symbolHref(id: string, d: GuideData): string | null {
  return pageOf(id, 'wordpress', d);
}

export interface EmbedView {
  id: string;
  title: string;
  code: string;
  output: string;
  return: string | null;
  error: string | null;
  sides: { side: Side; status: 'passed' | 'failed' | 'not-run'; detail?: string }[];
}

/**
 * An example as a guide embeds it: its code (only `lines`, 1-based and inclusive, when given), what it was checked to
 * print, return and throw, and how it ran on each side. Throws for an unknown id, so a broken embed fails the build.
 */
export function embedView(id: string, d: GuideData, lines?: [number, number]): EmbedView {
  const file = d.examples.files.find((e) => e.id === id);
  if (!file) throw new Error(`no example ${id}`);
  const view = exampleView(file, d);
  const code = lines ? view.code.split('\n').slice(lines[0] - 1, lines[1]).join('\n') : view.code;
  return { id, title: view.title, code, ...file.expect, sides: view.sides };
}
