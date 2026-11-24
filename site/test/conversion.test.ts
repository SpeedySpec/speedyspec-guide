/** The Rust-or-PHP page: which WordPress symbols SpeedySpec has converted to Rust. */
import { beforeAll, describe, expect, test } from 'bun:test';
import { join } from 'node:path';
import { conversionView } from '../src/model/conversion.ts';
import { type GuideData, readGuideData } from '../src/model/data.ts';

const fixtures = join(import.meta.dir, 'fixtures');
let d: GuideData;
beforeAll(async () => {
  d = await readGuideData({ GUIDE_DATA_DIR: join(fixtures, 'generated'), GUIDE_SOURCES: join(fixtures, 'sources.json'), GUIDE_SEAMS_DIR: join(fixtures, 'seams'), GUIDE_CONTENT_DIR: join(fixtures, 'content') });
});

describe('the Rust-or-PHP page', () => {
  test('reads_the_generated_states', () => {
    expect(d.conversion['function:add_filter']).toBe('runtime');
  });

  test('a_seam_with_rust_lists_its_symbols_by_state', () => {
    const view = conversionView({ ...d, conversion: { 'function:add_filter': 'runtime', 'class:WP_Hook': 'runtime', 'function:get_option': 'ported' } });
    const hooks = view.withRust.find((r) => r.seam === 'hooks')!;
    expect([hooks.runtime, hooks.ported, hooks.php]).toEqual([2, 0, 3]);
    expect(hooks.groups.map((g) => [g.label, g.members.map((m) => m.id)])).toEqual([
      ['Rust, in the runtime', ['class:WP_Hook', 'function:add_filter']],
      ['PHP', ['function:apply_filters', 'method:WP_Hook::add_filter', 'method:WP_Hook::apply_filters']],
    ]);
    const options = view.withRust.find((r) => r.seam === 'options')!;
    expect([options.runtime, options.ported, options.php]).toEqual([0, 1, 0]);
  });

  test('a_seam_wholly_in_php_is_one_line_with_its_count', () => {
    const view = conversionView({ ...d, conversion: { 'function:add_filter': 'runtime' } });
    expect(view.withRust.map((r) => r.seam)).toEqual(['hooks']);
    expect(view.phpOnly).toEqual([{ seam: 'options', name: 'Options', php: 1 }]);
  });
});
