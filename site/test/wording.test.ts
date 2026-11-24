import { beforeAll, describe, expect, test } from 'bun:test';
import { join } from 'node:path';
import { type GuideData, readGuideData } from '../src/model/data.ts';
import { evidenceLink, notDocumentedText, provenanceText, roleLabel, symbolTitle, verdictLabel, verdictTone } from '../src/model/wording.ts';
import { symbolView } from '../src/model/views.ts';

const fixtures = join(import.meta.dir, 'fixtures');
let d: GuideData;
beforeAll(async () => {
  d = await readGuideData({ GUIDE_DATA_DIR: join(fixtures, 'generated'), GUIDE_SOURCES: join(fixtures, 'sources.json'), GUIDE_SEAMS_DIR: join(fixtures, 'seams'), GUIDE_CONTENT_DIR: join(fixtures, 'content') });
});

describe('wording', () => {
  test('every verdict in words, with its tone', () => {
    expect([
      ['works-as-wordpress', 'Works as WordPress', 'ok'],
      ['works-with-differences', 'Works with differences', 'warn'],
      ['breaks', 'Breaks', 'bad'],
      ['new-in-speedyspec', 'New in SpeedySpec', 'new'],
      ['not-in-speedyspec', 'Not in SpeedySpec yet', 'muted'],
      ['unknown', 'Not yet compared', 'muted'],
    ].every(([v, label, tone]) => verdictLabel(v as never) === label && verdictTone(v as never) === tone)).toBe(true);
  });

  test("a WordPress page's provenance says only WordPress things", () => {
    // The fixture documents trunk 7.2-RC1 at ce78d2d; compat was recorded on 7.1.5.
    expect(provenanceText(symbolView('function:add_filter', 'wordpress', d), 'wordpress')).toBe('Verified against WordPress 7.1.5 · Since 0.71');
    expect(provenanceText(symbolView('function:apply_filters', 'wordpress', d), 'wordpress')).toBe('Read from WordPress 7.2-RC1 (trunk ce78d2d) · Since 0.71');
    expect(provenanceText(symbolView('class:WP_Hook', 'wordpress', d), 'wordpress')).toBe('Generated from WordPress 7.2-RC1 (trunk ce78d2d) · Since 2.0.0');
  });

  test("a_verified_page_names_its_own_seam's_compat_release", () => {
    const c = { ...d, compatAreas: { hooks: '7.0.0', options: '7.1.5' } };
    expect(provenanceText(symbolView('function:add_filter', 'wordpress', c), 'wordpress')).toBe('Verified against WordPress 7.0.0 · Since 0.71');
  });

  test("a SpeedySpec page's provenance says when SpeedySpec added it and whether it is native", () => {
    expect(provenanceText(symbolView('function:add_filter', 'speedyspec', d), 'speedyspec')).toBe('Added in SpeedySpec unreleased · Native (Rust)');
    expect(provenanceText(symbolView('function:get_option', 'speedyspec', d), 'speedyspec')).toBe('Not in SpeedySpec yet');
  });

  test('a_symbol_in_no_release_says_so', () => {
    const c = { ...d, wordpressHistory: { tags: d.wordpressHistory!.tags, symbols: {} } };
    expect(provenanceText(symbolView('class:WP_Hook', 'wordpress', c), 'wordpress')).toBe('Generated from WordPress 7.2-RC1 (trunk ce78d2d) · Not in a WordPress release yet');
  });

  test('roles read as words', () => {
    expect(roleLabel('classes-and-state')).toBe('Classes and state');
    expect(roleLabel('other')).toBe('Other');
  });

  test('evidence links to WordPress source at the pinned commit, and to the server at its pin', () => {
    const sources = { wordpress: { version: '7.2-RC1', commit: 'ce78d2d6eb' }, server: { repo: 'https://github.com/SpeedySpec/speedyspec-server.git', commit: 'abc' } };
    expect(evidenceLink({ kind: 'source', base: 'wp', file: 'wp-includes/plugin.php', from: 120, to: 134 }, sources)).toBe('https://github.com/WordPress/wordpress-develop/blob/ce78d2d6eb/src/wp-includes/plugin.php#L120-L134');
    expect(evidenceLink({ kind: 'scenario', area: 'hooks', name: 'x' }, sources)).toBe('https://github.com/SpeedySpec/speedyspec-server/blob/abc/compat/hooks/scenarios.json');
    expect(evidenceLink({ kind: 'source', base: 'ss', file: 'crates/x/src/a.rs', from: 3, to: 3 }, sources)).toBe('https://github.com/SpeedySpec/speedyspec-server/blob/abc/crates/x/src/a.rs#L3');
    expect(evidenceLink({ kind: 'test', path: 'a::b::c' }, sources)).toBe('https://github.com/SpeedySpec/speedyspec-server/blob/abc/crates/a/tests/b.rs');
  });
});

describe('notDocumentedText', () => {
  test('says where the verdict comes from', () => {
    expect(notDocumentedText('seam', '7.2-RC1')).toBe('Not in SpeedySpec yet: SpeedySpec provides this when its seam is ported.');
    expect(notDocumentedText('none', '7.1.5')).toBe('Not yet documented, and not yet compared with WordPress.');
    expect(notDocumentedText('page', '7.1.5')).toBe('Not yet documented.');
  });
});

describe('symbolTitle', () => {
  test('test_symbol_title_by_kind', () => {
    expect(symbolTitle({ kind: 'function', name: 'add_filter' })).toBe('add_filter()');
    expect(symbolTitle({ kind: 'method', name: 'apply_filters' })).toBe('apply_filters()');
    expect(symbolTitle({ kind: 'global', name: 'wp_filter' })).toBe('$wp_filter');
    expect(symbolTitle({ kind: 'class', name: 'WP_Hook' })).toBe('WP_Hook');
    expect(symbolTitle({ kind: 'filter', name: 'the_content' })).toBe('the_content');
  });
});
