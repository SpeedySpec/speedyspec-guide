import { describe, expect, test } from 'bun:test';
import { mkdtempSync } from 'node:fs';
import { tmpdir } from 'node:os';
import { join } from 'node:path';
import { buildSite, html } from './helpers.ts';

const empty = () => mkdtempSync(join(tmpdir(), 'guide-empty-'));

describe('the site', () => {
  test('refuses to build without generated data unless told an empty site is wanted', () => {
    const build = buildSite({ GUIDE_DATA_DIR: empty(), GUIDE_SEAMS_DIR: empty(), GUIDE_CONTENT_DIR: empty() });
    expect(build.exitCode).not.toBe(0);
    expect(build.output).toContain('inventory-wp.json is missing');
  }, 120_000);

  test('builds with no data', async () => {
    const build = buildSite({ GUIDE_DATA_DIR: empty(), GUIDE_SEAMS_DIR: empty(), GUIDE_CONTENT_DIR: empty(), GUIDE_ALLOW_EMPTY: '1' });
    expect(build.exitCode, build.output).toBe(0);
    const home = await html(build.dist, '/');
    expect(home.text('h1')).toEqual(['SpeedySpec Guide']);
    expect(home.attr('.home-cards a', 'href')).toEqual(['/guides/', '/install/', '/wordpress/', '/guides/#contributing']);
  });
});
