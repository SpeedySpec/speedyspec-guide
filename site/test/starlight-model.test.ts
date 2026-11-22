import { describe, expect, test } from 'bun:test';
import type { Guide } from '@speedyspec-guide/domain';
import { guidePath, guideTracks } from '../src/model/guides.ts';
import type { InstallPage } from '../src/model/install.ts';
import {
  chapterOf,
  guidePrevNext,
  guideSidebar,
  HEADER_LINKS,
  progressBars,
  headingsIn,
  installSidebar,
  REFERENCE_SIDEBAR,
  type SidebarGroup,
  type SidebarItem,
  type SidebarLink,
  seamSidebar,
} from '../src/model/starlight.ts';
import type { MemberView, RailView } from '../src/model/views.ts';

const guide = (g: Partial<Guide> & Pick<Guide, 'kind' | 'slug' | 'title'>): Guide => ({ file: `guides/${g.kind}/${g.slug}.mdx`, summary: '', examples: [], symbols: [], citations: [], ...g });

const first = guide({ kind: 'path', slug: 'your-first-plugin', title: 'Your first plugin', order: 1 });
const second = guide({ kind: 'path', slug: 'hooks-in-practice', title: 'Hooks in practice', order: 2 });
const third = guide({ kind: 'path', slug: 'keeping-it-safe', title: 'Keeping it safe', order: 3 });
const options = guide({ kind: 'topic', slug: 'options', seam: 'options', title: 'Options' });
const changing = guide({ kind: 'contributing', part: 'wordpress', slug: 'changing-a-function', title: 'Changing a function', order: 1 });
const porting = guide({ kind: 'contributing', part: 'speedyspec', slug: 'porting-a-function', title: 'Porting a function', order: 1 });
const data = { guides: [third, options, first, porting, second, changing] };

const groups = (items: SidebarItem[]) => items.filter((i): i is SidebarGroup => 'items' in i);
const links = (items: SidebarItem[]) => items.filter((i): i is SidebarLink => 'link' in i);

describe('guideSidebar', () => {
  test('test_guide_sidebar_groups_in_order', () => {
    expect(groups(guideSidebar(guideTracks(data))).map((g) => g.label)).toEqual(['Learning path', 'Topics', 'Contributing to WordPress', 'Contributing to SpeedySpec']);
    expect(groups(guideSidebar(guideTracks({ guides: [first, options] }))).map((g) => g.label)).toEqual(['Learning path', 'Topics']);
  });

  test('test_guide_sidebar_numbers_learning_path', () => {
    const path = links(groups(guideSidebar(guideTracks(data)))[0]!.items);
    expect(path[0]).toEqual({ label: '1 · Your first plugin', link: guidePath(first), attrs: { 'data-guide': guidePath(first), 'data-guide-track': 'path' } });
    expect(path.map((l) => l.label)).toEqual(['1 · Your first plugin', '2 · Hooks in practice', '3 · Keeping it safe']);
  });

  test('test_guide_sidebar_topics_unnumbered', () => {
    const topics = links(groups(guideSidebar(guideTracks(data)))[1]!.items);
    expect(topics).toEqual([{ label: 'Options', link: guidePath(options), attrs: { 'data-guide': guidePath(options), 'data-guide-track': 'topics' } }]);
  });

  test('test_guide_sidebar_contributing_tracks', () => {
    const [, , wp, ss] = groups(guideSidebar(guideTracks(data)));
    expect(links(wp!.items)[0]!.attrs).toEqual({ 'data-guide': guidePath(changing), 'data-guide-track': 'contributing-wordpress' });
    expect(links(ss!.items)[0]!.attrs).toEqual({ 'data-guide': guidePath(porting), 'data-guide-track': 'contributing-speedyspec' });
  });
});

describe('progressBars', () => {
  test('test_progress_bars_for_ordered_tracks_with_guides', () => {
    expect(progressBars(guideTracks(data))).toEqual([
      { track: 'path', label: 'Learning path', total: 3 },
      { track: 'contributing-wordpress', label: 'Contributing to WordPress', total: 1 },
      { track: 'contributing-speedyspec', label: 'Contributing to SpeedySpec', total: 1 },
    ]);
    expect(progressBars(guideTracks({ guides: [first, options] }))).toEqual([{ track: 'path', label: 'Learning path', total: 1 }]);
  });

  test('test_progress_bars_match_the_sidebar_groups', () => {
    const t = guideTracks(data);
    const sidebar = groups(guideSidebar(t));
    for (const bar of progressBars(t)) {
      const group = sidebar.find((g) => g.label === bar.label)!;
      expect(links(group.items).map((l) => l.attrs!['data-guide-track'])).toEqual(Array(bar.total).fill(bar.track));
    }
  });
});

describe('guidePrevNext', () => {
  test('test_prev_next_at_track_ends', () => {
    expect(guidePrevNext(first, data)).toEqual({ prev: false, next: { link: guidePath(second), label: 'Hooks in practice' } });
    expect(guidePrevNext(second, data)).toEqual({ prev: { link: guidePath(first), label: 'Your first plugin' }, next: { link: guidePath(third), label: 'Keeping it safe' } });
    expect(guidePrevNext(third, data).next).toBe(false);
    expect(guidePrevNext(options, data)).toEqual({ prev: false, next: false });
    expect(guidePrevNext(changing, data)).toEqual({ prev: false, next: false });
  });
});

describe('chapterOf', () => {
  test('test_chapter_of', () => {
    const t = guideTracks(data);
    expect(chapterOf(second, t)).toBe(2);
    expect(chapterOf(first, t)).toBe(1);
    expect(chapterOf(options, t)).toBeUndefined();
    expect(chapterOf(changing, t)).toBeUndefined();
  });
});

const member = (m: Partial<MemberView> & Pick<MemberView, 'id' | 'kind' | 'name'>): MemberView => ({ slug: m.name, href: `/wordpress/hooks/${m.name}/`, verdict: 'unknown', circular: false, ...m });

const rail: RailView = {
  seam: { id: 'hooks', name: 'Hooks' },
  roles: [
    {
      role: 'entry-point',
      href: '/wordpress/hooks/#role-entry-point',
      members: [
        member({ id: 'function:add_filter', kind: 'function', name: 'add_filter' }),
        member({ id: 'filter:the_content', kind: 'filter', name: 'the_content' }),
        member({ id: 'action:init', kind: 'action', name: 'init', circular: true }),
        member({ id: 'function:_wp_hidden', kind: 'function', name: '_wp_hidden', href: null }),
        member({
          id: 'class:WP_Hook',
          kind: 'class',
          name: 'WP_Hook',
          href: '/wordpress/hooks/class/WP_Hook/',
          methods: [member({ id: 'method:WP_Hook::apply_filters', kind: 'method', name: 'apply_filters', href: '/wordpress/hooks/class/WP_Hook/#apply_filters' })],
        }),
      ],
    },
    { role: 'internal-helper', href: '/wordpress/hooks/#role-internal-helper', members: null },
  ],
};

describe('seamSidebar', () => {
  test('test_seam_sidebar_starts_with_seam_link', () => {
    expect(seamSidebar(rail, 'wordpress')[0]).toEqual({ label: 'Hooks seam', link: '/wordpress/hooks/' });
    expect(seamSidebar(rail, 'speedyspec')[0]).toEqual({ label: 'Hooks seam', link: '/speedyspec/hooks/' });
  });

  test('test_seam_sidebar_collapsed_roles_link_to_role', () => {
    expect(seamSidebar(rail, 'wordpress')[2]).toEqual({ label: 'Internal helper', link: '/wordpress/hooks/#role-internal-helper' });
  });

  test('test_seam_sidebar_member_labels', () => {
    const role = seamSidebar(rail, 'wordpress')[1] as SidebarGroup;
    expect(role.label).toBe('Entry point');
    const l = links(role.items);
    expect(l.map((x) => x.label).slice(0, 3)).toEqual(['add_filter', 'filter the_content', 'action init ↻']);
    expect(l[2]!.attrs).toEqual({ class: 'circular' });
    expect(l[0]!.attrs).toBeUndefined();
  });

  test('test_seam_sidebar_member_without_page_links_to_role', () => {
    const role = seamSidebar(rail, 'wordpress')[1] as SidebarGroup;
    expect(links(role.items).find((x) => x.label === '_wp_hidden')!.link).toBe('/wordpress/hooks/#role-entry-point');
  });

  test('test_seam_sidebar_methods_only_on_class_page', () => {
    const items = (current?: string) => (seamSidebar(rail, 'wordpress', current)[1] as SidebarGroup).items;
    const nested = (current?: string) => groups(items(current));
    expect(nested()).toEqual([]);
    expect(nested('function:add_filter')).toEqual([]);
    const onClass = nested('class:WP_Hook');
    expect(onClass).toEqual([{ label: 'WP_Hook', items: [{ label: 'WP_Hook', link: '/wordpress/hooks/class/WP_Hook/' }, { label: '::apply_filters', link: '/wordpress/hooks/class/WP_Hook/#apply_filters' }] }]);
    expect(nested('method:WP_Hook::apply_filters')).toEqual(onClass);
    expect(links(items()).map((x) => x.label)).toContain('WP_Hook');
  });
});

describe('installSidebar', () => {
  test('test_install_sidebar_in_reading_order', () => {
    const page = (slug: string, order: number): InstallPage => ({ slug, title: slug.toUpperCase(), summary: '', order, file: `install/${slug}.mdx` }) as InstallPage;
    expect(installSidebar([page('server', 3), page('index', 0), page('cli', 2)])).toEqual([
      { label: 'INDEX', link: '/install/' },
      { label: 'CLI', link: '/install/cli/' },
      { label: 'SERVER', link: '/install/server/' },
    ]);
  });
});

describe('fixed navigation', () => {
  test('test_reference_sidebar', () => {
    expect(links(REFERENCE_SIDEBAR).map((l) => [l.label, l.link])).toEqual([
      ['Reference', '/reference/'],
      ['WordPress API', '/wordpress/'],
      ['SpeedySpec API', '/speedyspec/'],
      ['Conversion', '/speedyspec/conversion/'],
      ['Runtime', '/speedyspec/runtime/'],
      ['Coverage', '/coverage/'],
    ]);
  });

  test('test_header_links', () => {
    expect(HEADER_LINKS).toEqual([
      ['Guides', '/guides/'],
      ['Reference', '/reference/'],
      ['Install', '/install/'],
    ]);
  });
});

describe('headingsIn', () => {
  test('test_headings_in_adds_ids_from_text', () => {
    const r = headingsIn('<section><h2>Fired by</h2><p>x</p></section>');
    expect(r.html).toBe('<section><h2 id="fired-by">Fired by</h2><p>x</p></section>');
    expect(r.headings).toEqual([{ depth: 2, slug: 'fired-by', text: 'Fired by' }]);
  });

  test('test_headings_in_keeps_existing_ids_and_strips_tags', () => {
    const r = headingsIn('<h2 id="apply_filters" class="mono">::apply_filters()</h2><h2 class="x">A <code>b</code> &amp; c&#39;s</h2>');
    expect(r.html).toBe('<h2 id="apply_filters" class="mono">::apply_filters()</h2><h2 id="a-b-cs" class="x">A <code>b</code> &amp; c&#39;s</h2>');
    expect(r.headings).toEqual([
      { depth: 2, slug: 'apply_filters', text: '::apply_filters()' },
      { depth: 2, slug: 'a-b-cs', text: "A b & c's" },
    ]);
  });

  test('test_headings_in_dedupes_slugs', () => {
    const r = headingsIn('<h2>Examples</h2><h2>Examples</h2><h2 id="examples-2">Other</h2>');
    expect(r.headings.map((h) => h.slug)).toEqual(['examples', 'examples-3', 'examples-2']);
  });

  test('test_headings_in_ignores_attributes_that_end_in_id', () => {
    const r = headingsIn('<h2 data-id="x">Fired by</h2><h2 class="m" data-id="y" id="real">Real</h2>');
    expect(r.html).toBe('<h2 id="fired-by" data-id="x">Fired by</h2><h2 class="m" data-id="y" id="real">Real</h2>');
    expect(r.headings.map((h) => h.slug)).toEqual(['fired-by', 'real']);
  });

  test('test_headings_in_does_not_reserve_slugs_from_attributes_that_end_in_id', () => {
    const r = headingsIn('<h2 data-id="examples">A</h2><h2>Examples</h2>');
    expect(r.headings.map((h) => h.slug)).toEqual(['a', 'examples']);
  });

  test('test_headings_in_leaves_other_levels_alone', () => {
    const r = headingsIn('<h1>T</h1><h3>Sub</h3>');
    expect(r).toEqual({ html: '<h1>T</h1><h3>Sub</h3>', headings: [] });
  });
});
