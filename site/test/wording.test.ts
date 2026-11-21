import { beforeAll, describe, expect, test } from 'bun:test';
import { join } from 'node:path';
import { type GuideData, readGuideData } from '../src/model/data.ts';
import { evidenceLink, notDocumentedText, provenanceText, roleLabel, verdictLabel, verdictTone } from '../src/model/wording.ts';
import { symbolView } from '../src/model/views.ts';

const fixtures = join(import.meta.dir, 'fixtures');
let d: GuideData;
beforeAll(async () => {
  d = await readGuideData({ GUIDE_DATA_DIR: join(fixtures, 'generated'), GUIDE_SEAMS_DIR: join(fixtures, 'seams'), GUIDE_CONTENT_DIR: join(fixtures, 'content') });
});

describe('wording', () => {
  test('every verdict in words, with its tone', () => {
    expect([
      ['works-as-wordpress', 'Works as WordPress', 'ok'],
      ['works-with-differences', 'Works with differences', 'warn'],
      ['breaks', 'Breaks', 'bad'],
      ['new-in-speedyspec', 'New in SpeedySpec', 'new'],
      ['same-code', 'Same code as WordPress', 'ok'],
      ['modified', 'Modified in SpeedySpec', 'warn'],
      ['removed', "Not in SpeedySpec's packages/", 'bad'],
      ['unknown', 'Not yet compared', 'muted'],
    ].every(([v, label, tone]) => verdictLabel(v as never) === label && verdictTone(v as never) === tone)).toBe(true);
  });

  test("a WordPress page's provenance says only WordPress things", () => {
    expect(provenanceText(symbolView('function:add_filter', 'wordpress', d), 'wordpress')).toBe('Verified against WordPress 7.1.5 · Since 0.71');
    expect(provenanceText(symbolView('class:WP_Hook', 'wordpress', d), 'wordpress')).toBe('Generated from WordPress 7.1.5 · Since 2.0.0');
  });

  test("a SpeedySpec page's provenance says when SpeedySpec added it and whether it is native", () => {
    expect(provenanceText(symbolView('function:add_filter', 'speedyspec', d), 'speedyspec')).toBe('Added in SpeedySpec unreleased · Native (Rust)');
    expect(provenanceText(symbolView('function:get_option', 'speedyspec', d), 'speedyspec')).toBe("Added in SpeedySpec unreleased · WordPress's PHP");
  });

  test('roles read as words', () => {
    expect(roleLabel('classes-and-state')).toBe('Classes and state');
    expect(roleLabel('other')).toBe('Other');
  });

  test('evidence links to WordPress source at the release, and to scenarios at the pinned server', () => {
    const sources = { wordpress: { version: '7.1.5' }, server: { repo: 'https://github.com/SpeedySpec/speedyspec-server.git', commit: 'abc' }, fork: { repo: 'https://github.com/SpeedySpec/wordpress-develop.git', commit: 'def', path: 'packages' } };
    expect(evidenceLink({ kind: 'source', base: 'wp', file: 'wp-includes/plugin.php', from: 120, to: 134 }, sources)).toBe('https://github.com/WordPress/wordpress-develop/blob/7.1.5/src/wp-includes/plugin.php#L120-L134');
    expect(evidenceLink({ kind: 'scenario', area: 'hooks', name: 'x' }, sources)).toBe('https://github.com/SpeedySpec/speedyspec-server/blob/abc/compat/hooks/scenarios.json');
    expect(evidenceLink({ kind: 'source', base: 'ss', file: 'wp-plugin/a.php', from: 3, to: 3 }, sources)).toBe('https://github.com/SpeedySpec/wordpress-develop/blob/def/packages/wp-plugin/a.php#L3');
    expect(evidenceLink({ kind: 'test', path: 'a::b::c' }, sources)).toBe('https://github.com/SpeedySpec/speedyspec-server/blob/abc/crates/a/tests/b.rs');
  });
});

describe('notDocumentedText', () => {
  test('says where the verdict comes from', () => {
    expect(notDocumentedText('fork', '7.1.5')).toBe("Not yet documented. The verdict comes from comparing SpeedySpec's packages/ tree with WordPress 7.1.5.");
    expect(notDocumentedText('none', '7.1.5')).toBe('Not yet documented, and not yet compared with WordPress.');
    expect(notDocumentedText('page', '7.1.5')).toBe('Not yet documented.');
  });
});
