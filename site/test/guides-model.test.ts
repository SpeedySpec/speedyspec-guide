import { describe, expect, test } from 'bun:test';
import { cpSync, mkdirSync, mkdtempSync, writeFileSync } from 'node:fs';
import { tmpdir } from 'node:os';
import { join } from 'node:path';
import { readGuideData } from '../src/model/data.ts';
import { symbolHref, topicReferenceHref } from '../src/model/guides.ts';

const fixtures = join(import.meta.dir, 'fixtures');
const env = (seams: string) => ({ GUIDE_DATA_DIR: join(fixtures, 'generated'), GUIDE_SOURCES: join(fixtures, 'sources.json'), GUIDE_SEAMS_DIR: seams, GUIDE_CONTENT_DIR: join(fixtures, 'content') });

/** The fixtures plus a seam that only SpeedySpec has: it lists a runtime class and no WordPress files. */
async function withSpeedySpecOnlySeam() {
  const seams = mkdtempSync(join(tmpdir(), 'guide-seams-'));
  cpSync(join(fixtures, 'seams'), seams, { recursive: true });
  mkdirSync(join(seams, 'container'));
  writeFileSync(join(seams, 'container', 'seam.yaml'), 'name: Container\njob: Holds services.\nported: true\nfiles: []\nsymbols: ["class:SpeedySpec\\\\Hooks\\\\Hook"]\n');
  return readGuideData(env(seams));
}

describe('guide links', () => {
  test('test_topic_reference_of_speedyspec_only_seam', async () => {
    const d = await withSpeedySpecOnlySeam();
    expect(topicReferenceHref('container', d)).toBe('/speedyspec/container/');
    expect(topicReferenceHref('hooks', d)).toBe('/wordpress/hooks/');
  });

  test('test_sym_links_speedyspec_only_symbols', async () => {
    const d = await withSpeedySpecOnlySeam();
    expect(symbolHref('class:SpeedySpec\\Hooks\\Hook', d)).toStartWith('/speedyspec/container/');
  });

  test('test_sym_links_methods_to_their_class', async () => {
    const d = await readGuideData(env(join(fixtures, 'seams')));
    expect(symbolHref('method:WP_Hook::apply_filters', d)).toBe('/wordpress/hooks/class/WP_Hook/#apply_filters');
  });
});
