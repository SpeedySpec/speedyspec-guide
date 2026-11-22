/**
 * Adapters from the guide's views to the shapes Starlight's page component takes: sidebar items and previous/next
 * links. Plain functions over plain data; the types are declared here, structurally compatible with Starlight's, so
 * nothing in the model depends on Starlight.
 */
import type { Guide } from '@speedyspec-guide/domain';
import type { GuideData } from './data.ts';
import { type GuideTracks, guidePath, neighbours } from './guides.ts';
import { type InstallPage, inReadingOrder, installPath } from './install.ts';
import type { MemberView, RailView, Section } from './views.ts';
import { roleLabel } from './wording.ts';

/** A sidebar entry that links somewhere. */
export type SidebarLink = { label: string; link: string; attrs?: Record<string, string> };
/** A labelled group of sidebar entries. */
export type SidebarGroup = { label: string; items: SidebarItem[]; collapsed?: boolean };
/** One sidebar entry, as Starlight's `sidebar` prop takes it. */
export type SidebarItem = SidebarLink | SidebarGroup;
/** A previous or next page link, as Starlight's `prev` / `next` frontmatter takes it. */
export type PageLink = { link: string; label: string };
/** The guide tracks a reader can make progress through, plus topics (ticked, never counted). */
export type Track = 'path' | 'contributing-wordpress' | 'contributing-speedyspec' | 'topics';

/** The site's sections, in the header and the mobile menu. */
export const HEADER_LINKS: readonly (readonly [label: string, href: string])[] = [
  ['Guides', '/guides/'],
  ['Reference', '/reference/'],
  ['Install', '/install/'],
];

/** The sidebar of the reference overview pages. */
export const REFERENCE_SIDEBAR: SidebarItem[] = [
  { label: 'Reference', link: '/reference/' },
  { label: 'WordPress API', link: '/wordpress/' },
  { label: 'SpeedySpec API', link: '/speedyspec/' },
  { label: 'Conversion', link: '/speedyspec/conversion/' },
  { label: 'Runtime', link: '/speedyspec/runtime/' },
  { label: 'Coverage', link: '/coverage/' },
];

function guideLink(g: Guide, track: Track, label: string): SidebarLink {
  const path = guidePath(g);
  return { label, link: path, attrs: { 'data-guide': path, 'data-guide-track': track } };
}

/** One guide track, as the sidebar groups it and the progress bars count it. */
interface TrackInfo {
  track: Track;
  label: string;
  /** Whether its guides are numbered in the sidebar (the learning path's chapters). */
  numbered: boolean;
  /** Whether it is read in order, so it gets a progress bar (topics are ticked but not counted). */
  ordered: boolean;
  guides: (t: GuideTracks) => Guide[];
}

/** The guide tracks, in sidebar order: the one place their ids and labels are written. */
const TRACKS: readonly TrackInfo[] = [
  { track: 'path', label: 'Learning path', numbered: true, ordered: true, guides: (t) => t.path },
  { track: 'topics', label: 'Topics', numbered: false, ordered: false, guides: (t) => t.topics },
  { track: 'contributing-wordpress', label: 'Contributing to WordPress', numbered: false, ordered: true, guides: (t) => t.contributing.wordpress },
  { track: 'contributing-speedyspec', label: 'Contributing to SpeedySpec', numbered: false, ordered: true, guides: (t) => t.contributing.speedyspec },
];

/**
 * Every guide, by track. Learning-path guides are numbered; each link carries its path and track for the read ticks.
 *
 * @param t
 *     The guides by track.
 * @return
 *     One group per track that has guides: Learning path, Topics, Contributing to WordPress, Contributing to SpeedySpec.
 */
export function guideSidebar(t: GuideTracks): SidebarItem[] {
  return TRACKS.map((info) => ({ info, guides: info.guides(t) }))
    .filter(({ guides }) => guides.length > 0)
    .map(({ info, guides }) => ({ label: info.label, items: guides.map((g, i) => guideLink(g, info.track, info.numbered ? `${i + 1} · ${g.title}` : g.title)) }));
}

/**
 * The progress bars above the guide sidebar: one per ordered track that has guides, in sidebar order.
 *
 * @param t
 *     The guides by track.
 * @return
 *     Each bar's track id (matching the links' data-guide-track), label and number of guides.
 */
export function progressBars(t: GuideTracks): { track: Track; label: string; total: number }[] {
  return TRACKS.filter((info) => info.ordered)
    .map((info) => ({ track: info.track, label: info.label, total: info.guides(t).length }))
    .filter((b) => b.total > 0);
}

/**
 * A guide's previous and next guides in its track, as Starlight's prev/next links; `false` where there is none.
 *
 * @param g
 *     The guide.
 * @param d
 *     All guides.
 * @return
 *     Previous and next links; topics have neither.
 */
export function guidePrevNext(g: Guide, d: Pick<GuideData, 'guides'>): { prev: PageLink | false; next: PageLink | false } {
  const { prev, next } = neighbours(g, d);
  const link = (x: Guide | null): PageLink | false => (x ? { link: guidePath(x), label: x.title } : false);
  return { prev: link(prev), next: link(next) };
}

/**
 * A learning-path guide's chapter number.
 *
 * @param g
 *     The guide.
 * @param t
 *     The guides by track.
 * @return
 *     1-based position in the learning path; undefined for any other guide.
 */
export function chapterOf(g: Guide, t: GuideTracks): number | undefined {
  const i = g.kind === 'path' ? t.path.findIndex((x) => x.file === g.file) : -1;
  return i >= 0 ? i + 1 : undefined;
}

// Hooks of both kinds can share a name, so the sidebar says which.
const memberLabel = (m: MemberView) => `${m.kind === 'filter' || m.kind === 'action' ? `${m.kind} ${m.name}` : m.name}${m.circular ? ' ↻' : ''}`;

/**
 * A reference page's sidebar: its seam, then the seam's roles. Only the current symbol's role lists its members
 * (the others link to the seam page), and a class's methods show only on that class's pages, as the rail did.
 *
 * @param rail
 *     The page's rail view.
 * @param section
 *     Which reference the page is in.
 * @param current
 *     The page's symbol id, if it is a symbol page.
 * @return
 *     Sidebar items.
 */
export function seamSidebar(rail: RailView, section: Section, current?: string): SidebarItem[] {
  const open = (classId: string) => current === classId || (current?.startsWith(`method:${classId.slice('class:'.length)}::`) ?? false);
  const item = (m: MemberView, roleHref: string): SidebarItem => {
    const link: SidebarLink = { label: memberLabel(m), link: m.href ?? roleHref, ...(m.circular ? { attrs: { class: 'circular' } } : {}) };
    if (!m.methods || m.methods.length === 0 || !open(m.id)) return link;
    return { label: m.name, items: [link, ...m.methods.map((x) => ({ label: `::${x.name}`, link: x.href ?? roleHref }))] };
  };
  return [
    { label: `${rail.seam.name} seam`, link: `/${section}/${rail.seam.id}/` },
    ...rail.roles.map((r): SidebarItem => (r.members === null ? { label: roleLabel(r.role), link: r.href } : { label: roleLabel(r.role), items: r.members.map((m) => item(m, r.href)) })),
  ];
}

/**
 * The installation guide's pages, in reading order.
 *
 * @param pages
 *     The install pages, in any order.
 * @return
 *     One link per page.
 */
export function installSidebar(pages: InstallPage[]): SidebarItem[] {
  return inReadingOrder(pages).map((p) => ({ label: p.title, link: installPath(p.slug) }));
}

/** A heading for Starlight's "On this page". */
export type Heading = { depth: number; slug: string; text: string };

const ENTITIES: Record<string, string> = { '&amp;': '&', '&lt;': '<', '&gt;': '>', '&quot;': '"', '&#39;': "'", '&#x27;': "'" };
const plainText = (html: string) =>
  html
    .replace(/<[^>]*>/g, '')
    .replace(/&(amp|lt|gt|quot|#39|#x27);/g, (e) => ENTITIES[e]!)
    .trim();
const slugOf = (text: string) =>
  text
    .toLowerCase()
    .replace(/[^\p{L}\p{N}\s_-]/gu, '')
    .trim()
    .replace(/\s+/g, '-');

/**
 * The level-2 headings of rendered page HTML, for "On this page", giving each heading without an id one made from its
 * text (unique within the page).
 *
 * @param html
 *     The page body as rendered.
 * @return
 *     The body with every h2 carrying an id, and the h2s in page order.
 */
export function headingsIn(html: string): { html: string; headings: Heading[] } {
  // An id attribute is `id="…"` after whitespace; `\b` would also match the end of data-id or x-id.
  const taken = new Set([...html.matchAll(/<h2(?:\s[^>]*)?\sid="([^"]*)"/g)].map((m) => m[1]!));
  const headings: Heading[] = [];
  const out = html.replace(/<h2(\s[^>]*)?>([\s\S]*?)<\/h2>/g, (whole, attrs: string | undefined, inner: string) => {
    const text = plainText(inner);
    const existing = attrs?.match(/\sid="([^"]*)"/)?.[1];
    if (existing !== undefined) {
      headings.push({ depth: 2, slug: existing, text });
      return whole;
    }
    const base = slugOf(text) || 'section';
    let slug = base;
    for (let n = 2; taken.has(slug); n++) slug = `${base}-${n}`;
    taken.add(slug);
    headings.push({ depth: 2, slug, text });
    return `<h2 id="${slug}"${attrs ?? ''}>${inner}</h2>`;
  });
  return { html: out, headings };
}
