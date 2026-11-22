import { describe, expect, test } from 'bun:test';
import { mkdtempSync } from 'node:fs';
import { tmpdir } from 'node:os';
import { join } from 'node:path';
import { guideRoot } from '../src/model/root.ts';

const root = join(import.meta.dir, '..', '..');

describe('guideRoot', () => {
  test('test_finds_root_from_the_sources', () => {
    expect(guideRoot(join(root, 'site', 'src', 'model', 'data.ts'))).toBe(root);
  });

  test('test_finds_root_from_a_bundled_chunk_at_any_depth', () => {
    expect(guideRoot(join(root, 'site', 'dist', '.prerender', 'chunks', 'data.mjs'))).toBe(root);
    expect(guideRoot(join(root, 'site', 'dist', 'chunks', 'data.mjs'))).toBe(root);
  });

  test('test_falls_back_to_the_working_directory', () => {
    const outside = join(mkdtempSync(join(tmpdir(), 'guide-root-')), 'chunks', 'data.mjs');
    expect(guideRoot(outside, join(root, 'site'))).toBe(root);
  });

  test('test_throws_when_no_root_above_either', () => {
    const outside = mkdtempSync(join(tmpdir(), 'guide-root-'));
    expect(() => guideRoot(join(outside, 'x.mjs'), outside)).toThrow('guide.config.json');
  });
});
