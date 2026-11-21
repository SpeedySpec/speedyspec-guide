import { beforeAll, describe, expect, test } from 'bun:test';
import { join } from 'node:path';
import { buildSite, html } from './helpers.ts';

const fixtures = join(import.meta.dir, 'fixtures');
let dist = '';
beforeAll(() => {
  const build = buildSite({ GUIDE_DATA_DIR: join(fixtures, 'generated'), GUIDE_SEAMS_DIR: join(fixtures, 'seams'), GUIDE_CONTENT_DIR: join(fixtures, 'content'), GUIDE_COMPONENT_TESTS: '1' });
  if (build.exitCode !== 0) throw new Error(build.output);
  dist = build.dist;
}, 180_000);

const page = (name: string) => html(dist, `/component-tests/${name}/`);

describe('components', () => {
  test("the rail marks the current member, lists only its role, and links the seam's other roles", async () => {
    const p = await page('rail');
    expect(p.text('.rail-member[aria-current="page"]')).toEqual(['add_filter↻ (circular)']);
    expect(p.text('.rail-methods .rail-member')).toEqual([]);
    expect(p.text('.rail-member.circular')).toEqual(['add_filter↻ (circular)']);
    expect(p.text('.rail-role-link')).toEqual(['Run', 'Classes and state', 'Other']);
    expect(p.attr('.rail-role-link', 'href')).toEqual(['/wordpress/hooks/#role-run', '/wordpress/hooks/#role-classes-and-state', '/wordpress/hooks/#role-other']);
  });

  test('the head has the name, the pill and the provenance line', async () => {
    const p = await page('head');
    expect(p.text('h1')).toEqual(['add_filter()']);
    expect(p.text('.head .pill')).toEqual(['Works with differences']);
    expect(p.text('.provenance .muted')).toEqual(['Verified against WordPress 7.1.5 · Since 0.71']);
  });

  test('a circular chip is red and says so', async () => {
    const p = await page('panel');
    expect(p.text('.chip.circular')).toEqual(['get_option circular']);
    expect(p.text('.panel dt')).toEqual(expect.arrayContaining(['writes', 'calls into Options']));
  });

  test('every verdict pill', async () => {
    expect((await page('pills')).text('.pill')).toEqual(['Works as WordPress', 'Works with differences', 'Breaks', 'New in SpeedySpec', 'Not in SpeedySpec yet', 'Not yet compared']);
  });

  test('examples: title, code without the title comment, both sides passed', async () => {
    const p = await page('examples');
    expect(p.text('.example h3')).toEqual(['Change a value WordPress passes through a filter.']);
    expect(p.text('.example code')[0]).not.toContain('// Change a value');
    expect(p.text('.ran-passed')).toEqual(['✓ WordPress', '✓ SpeedySpec']);
  });

  test('a diagram is a picture with a dark source', async () => {
    const p = await page('diagram');
    expect(p.count('figure.diagram picture')).toBe(1);
    expect(p.attr('picture source', 'media')).toEqual(['(prefers-color-scheme: dark)']);
    expect(p.attr('picture img', 'src')[0]).toStartWith('data:image/svg+xml;base64,');
  });

  test('On SpeedySpec lists the difference and links the SpeedySpec page', async () => {
    const p = await page('on-speedyspec');
    expect(p.text('.on-speedyspec li')).toEqual(['Replacing $wp_filter wholesale is not seen.']);
    expect(p.attr('.on-speedyspec a', 'href')).toEqual(['/speedyspec/hooks/add_filter/']);
  });
});
