import { beforeAll, describe, expect, test } from 'bun:test';
import { mkdirSync, mkdtempSync, writeFileSync } from 'node:fs';
import { tmpdir } from 'node:os';
import { join } from 'node:path';
import { readGuideData } from '../src/model/data.ts';
import { type InstallPage, inReadingOrder, installNeighbours, installPage, installPath } from '../src/model/install.ts';
import { fixtureSite } from './fixture-build.ts';
import { html } from './helpers.ts';

const fixtures = join(import.meta.dir, 'fixtures');
const page = (slug: string, order: number): InstallPage => ({ slug, title: slug, summary: '', order, file: `install/${slug}.mdx` });

describe('installation guide model', () => {
  test('the first page is /install/, the others sit under it', () => {
    expect(installPath('index')).toBe('/install/');
    expect(installPath('server')).toBe('/install/server/');
  });

  test('a page needs a title and an order; the summary is optional', () => {
    expect(installPage('cli', { title: 'The CLI', order: 10 }, 'install/cli.mdx')).toEqual({ slug: 'cli', title: 'The CLI', summary: '', order: 10, file: 'install/cli.mdx' });
    expect(() => installPage('cli', { order: 10 }, 'install/cli.mdx')).toThrow('needs a title');
    expect(() => installPage('cli', { title: 'The CLI' }, 'install/cli.mdx')).toThrow('numeric order');
    expect(() => installPage('cli', { title: 'The CLI', order: '10' }, 'install/cli.mdx')).toThrow('numeric order');
    expect(() => installPage('cli', { title: 'The CLI', order: 1, summary: 3 }, 'install/cli.mdx')).toThrow('summary');
  });

  test('a file name must be lowercase words joined by hyphens, since it becomes the address', () => {
    expect(() => installPage('Server Setup', { title: 'x', order: 1 }, 'install/Server Setup.mdx')).toThrow('lowercase');
    expect(installPage('building-from-source', { title: 'x', order: 1 }, 'f').slug).toBe('building-from-source');
  });

  test('pages are read in order, and two pages may not share one', () => {
    expect(inReadingOrder([page('b', 2), page('a', 1)]).map((p) => p.slug)).toEqual(['a', 'b']);
    expect(() => inReadingOrder([page('a', 1), page('b', 1)])).toThrow('same order');
  });

  test('each page knows the one before and after it', () => {
    const pages = [page('server', 20), page('index', 0), page('cli', 10)];
    expect(installNeighbours(pages, 'index')).toEqual({ previous: null, next: page('cli', 10) });
    expect(installNeighbours(pages, 'cli')).toEqual({ previous: page('index', 0), next: page('server', 20) });
    expect(installNeighbours(pages, 'server')).toEqual({ previous: page('cli', 10), next: null });
    expect(installNeighbours(pages, 'missing')).toEqual({ previous: null, next: null });
  });
});

describe('reading the guide', () => {
  test('reads content/install/ in reading order', async () => {
    const d = await readGuideData({ GUIDE_DATA_DIR: join(fixtures, 'generated'), GUIDE_SOURCES: join(fixtures, 'sources.json'), GUIDE_SEAMS_DIR: join(fixtures, 'seams'), GUIDE_CONTENT_DIR: join(fixtures, 'content') });
    expect(d.install.map((p) => p.slug)).toEqual(['index', 'cli', 'server']);
    expect(d.install[1]).toEqual({ slug: 'cli', title: 'The CLI', summary: 'Installing the CLI.', order: 10, file: 'install/cli.mdx' });
  });

  test('a content folder without install/ gives no pages', async () => {
    const content = mkdtempSync(join(tmpdir(), 'guide-content-'));
    const d = await readGuideData({ GUIDE_DATA_DIR: join(fixtures, 'generated'), GUIDE_SOURCES: join(fixtures, 'sources.json'), GUIDE_SEAMS_DIR: join(fixtures, 'seams'), GUIDE_CONTENT_DIR: content });
    expect(d.install).toEqual([]);
  });

  test('a page with bad front matter stops the read, naming the file', async () => {
    const content = mkdtempSync(join(tmpdir(), 'guide-content-'));
    mkdirSync(join(content, 'install'));
    writeFileSync(join(content, 'install', 'cli.mdx'), '---\nsummary: no title\norder: 1\n---\nText.\n');
    const read = readGuideData({ GUIDE_DATA_DIR: join(fixtures, 'generated'), GUIDE_SOURCES: join(fixtures, 'sources.json'), GUIDE_SEAMS_DIR: join(fixtures, 'seams'), GUIDE_CONTENT_DIR: content });
    expect(read).rejects.toThrow('install/cli.mdx: front matter needs a title');
  });
});

describe('installation guide pages', () => {
  let dist = '';
  beforeAll(() => {
    dist = fixtureSite();
  }, 240_000);

  test('the home page and the header link to the guide', async () => {
    const home = await html(dist, '/');
    expect(home.attr('main a', 'href')).toContain('/install/');
    expect(home.attr('.site-links a', 'href')).toContain('/install/');
  });

  test('the first page lists every page in order', async () => {
    const index = await html(dist, '/install/');
    expect(index.text('h1')).toEqual(['Installing SpeedySpec']);
    expect(index.attr('.install-contents a', 'href')).toEqual(['/install/', '/install/cli/', '/install/server/']);
    expect(index.attr('.site-links a[aria-current="page"]', 'href')).toEqual(['/install/']);
    expect(index.attr('#starlight__sidebar ul.top-level a', 'href')).toEqual(['/install/', '/install/cli/', '/install/server/']);
  });

  test('a page renders its MDX and links to its neighbours', async () => {
    const cli = await html(dist, '/install/cli/');
    expect(cli.text('h1')).toEqual(['The CLI']);
    expect(cli.text('.prose p').join(' ')).toContain("The fixture guide’s CLI page.");
    expect(cli.text('.prose pre').join(' ')).toContain('speedyspec --version');
    expect(cli.attr('.pagination-links a', 'href')).toEqual(['/install/', '/install/server/']);
    expect(cli.attr('#starlight__sidebar a[aria-current="page"]', 'href')).toEqual(['/install/cli/']);
  });
});
