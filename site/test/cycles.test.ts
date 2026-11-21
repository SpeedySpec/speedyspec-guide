import { beforeAll, describe, expect, test } from 'bun:test';
import { join } from 'node:path';
import { type GuideData, readGuideData } from '../src/model/data.ts';
import { seamCycles } from '../src/model/sections.ts';

const fixtures = join(import.meta.dir, 'fixtures');
let d: GuideData;
beforeAll(async () => {
  d = await readGuideData({ GUIDE_DATA_DIR: join(fixtures, 'generated'), GUIDE_SEAMS_DIR: join(fixtures, 'seams'), GUIDE_CONTENT_DIR: join(fixtures, 'content') });
});

describe('seamCycles', () => {
  test("lists a cycle through each member in a circular group, even when the group's sample path misses the seam", () => {
    const elsewhere = structuredClone(d);
    // The stored sample path goes round other symbols only; the member is still in the group.
    elsewhere.cycles.symbol = [{ path: ['function:x', 'function:y', 'function:x'], possible: false }];
    elsewhere.cycles.components = [['function:add_filter', 'function:get_option', 'function:x', 'function:y']];
    expect(seamCycles('hooks', elsewhere)).toEqual([{ path: ['function:add_filter', 'function:get_option', 'function:add_filter'], possible: false }]);
  });

  test('a seam with no member in a circular group has none', () => {
    const none = structuredClone(d);
    none.cycles.components = [];
    expect(seamCycles('hooks', none)).toEqual([]);
  });
});
