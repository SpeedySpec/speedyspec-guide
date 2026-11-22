import { describe, expect, test } from 'bun:test';
import type { Assignment, ContentPage, Seam } from '@speedyspec-guide/domain';
import { computeCoverage } from '../src/coverage.ts';
import { PortedSeamCovered } from '../src/validate/rules.ts';
import type { ValidationContext } from '../src/validate/rule.ts';

const seam = (id: string, ported: boolean): Seam => ({ id, name: id, job: 'j', ported, files: [], symbols: [], exclude: [], elsewhere: [], roles: {}, edges: [], wordpress: [] });
const assignment: Assignment = {
  seamOf: { 'function:a': 'hooks', 'function:b': 'hooks', 'class:C': 'hooks', 'method:C::m': 'hooks', 'function:o': 'options' },
  unassigned: ['function:x', 'function:y'],
  conflicts: [],
};
const pages: ContentPage[] = [
  { page: 'wordpress/hooks/a.mdx', section: 'wordpress', seam: 'hooks', symbol: 'function:a' },
  { page: 'speedyspec/hooks/a.mdx', section: 'speedyspec', seam: 'hooks', symbol: 'function:a' },
  { page: 'wordpress/hooks/C.mdx', section: 'wordpress', seam: 'hooks', symbol: 'class:C' },
  { page: 'wordpress/hooks/_seam.mdx', section: 'wordpress', seam: 'hooks' },
];
const seams = [seam('hooks', true), seam('options', false)];

describe('computeCoverage', () => {
  test('counts pages per section, lists what is missing, and counts methods with their class', () => {
    expect(computeCoverage(assignment, seams, pages)).toEqual({
      seams: [
        { id: 'hooks', ported: true, members: 3, wordpressPages: 2, speedyspecPages: 1, missing: ['class:C', 'function:b'] },
        { id: 'options', ported: false, members: 1, wordpressPages: 0, speedyspecPages: 0, missing: ['function:o'] },
      ],
      unassigned: 2,
    });
  });
});

describe('PortedSeamCovered', () => {
  const ctx = (requirePortedCoverage: boolean) => ({ assignment, seams, pages, config: { requireAllAssigned: false, requirePortedCoverage } }) as unknown as ValidationContext;
  test('fails each missing member of a ported seam when required', async () => {
    expect(await PortedSeamCovered.check(ctx(true))).toEqual([
      { rule: 'PortedSeamCovered', where: 'class:C', message: 'the hooks seam is ported: needs a WordPress page and a SpeedySpec page (missing: SpeedySpec)' },
      { rule: 'PortedSeamCovered', where: 'function:b', message: 'the hooks seam is ported: needs a WordPress page and a SpeedySpec page (missing: WordPress, SpeedySpec)' },
    ]);
  });
  test('fails nothing when not required', async () => {
    expect(await PortedSeamCovered.check(ctx(false))).toEqual([]);
  });
});
