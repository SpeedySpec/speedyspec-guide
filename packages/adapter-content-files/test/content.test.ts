import { describe, expect, test } from 'bun:test';
import { mkdirSync, mkdtempSync, writeFileSync } from 'node:fs';
import { tmpdir } from 'node:os';
import { dirname, join } from 'node:path';
import { ContentFiles } from '../src/index.ts';

function content(pages: Record<string, string>): string {
  const dir = mkdtempSync(join(tmpdir(), 'content-'));
  for (const [path, body] of Object.entries(pages)) {
    mkdirSync(dirname(join(dir, path)), { recursive: true });
    writeFileSync(join(dir, path), body);
  }
  return dir;
}

describe('ContentFiles', () => {
  test('lists pages with their section and seam', async () => {
    const c = new ContentFiles(content({ 'wordpress/hooks/add_filter.mdx': '#', 'speedyspec/hooks/a/b.mdx': '#', 'other/x.mdx': '#' }));
    expect(await c.pages()).toEqual([
      { page: 'speedyspec/hooks/a/b.mdx', section: 'speedyspec', seam: 'hooks' },
      { page: 'wordpress/hooks/add_filter.mdx', section: 'wordpress', seam: 'hooks' },
    ]);
  });

  test("a page's symbol comes from its front matter", async () => {
    const c = new ContentFiles(content({ 'wordpress/hooks/add_filter.mdx': '---\nsymbol: function:add_filter\n---\n\nText.' }));
    expect(await c.pages()).toEqual([{ page: 'wordpress/hooks/add_filter.mdx', section: 'wordpress', seam: 'hooks', symbol: 'function:add_filter' }]);
  });

  test('a quoted symbol in the front matter is read as YAML reads it', async () => {
    const c = new ContentFiles(content({ 'speedyspec/hooks/a.mdx': '---\nsymbol: "function:has_filter"\nverdict: works-as-wordpress\n---\n\nText.' }));
    expect((await c.pages())[0]?.symbol).toBe('function:has_filter');
  });

  test('reads <Ev/> citations', async () => {
    const c = new ContentFiles(content({ 'wordpress/hooks/add_filter.mdx': 'Returns true. <Ev scenario="add_filter_returns_true"/>\n' }));
    expect(await c.citations()).toEqual([{ page: 'wordpress/hooks/add_filter.mdx', section: 'wordpress', seam: 'hooks', citation: { kind: 'scenario', area: 'hooks', name: 'add_filter_returns_true' } }]);
  });

  test('Ev tags shown inside code are not citations', async () => {
    const c = new ContentFiles(content({ 'wordpress/hooks/a.mdx': 'Write `<Ev example="<seam>/<x>"/>`.\n\n```\n<Ev scenario="nope"/>\n```\n\nReal: <Ev scenario="add_filter_returns_true"/>\n' }));
    expect((await c.citations()).map((x) => x.citation)).toEqual([{ kind: 'scenario', area: 'hooks', name: 'add_filter_returns_true' }]);
  });

  test('reads versions from Changed, Deprecated and Removed', async () => {
    const c = new ContentFiles(content({ 'wordpress/hooks/a.mdx': '<Changed version="6.5.0" base="wp"/> <Deprecated version="1.2.0"/>' }));
    expect(await c.versions()).toEqual([
      { page: 'wordpress/hooks/a.mdx', version: '6.5.0', base: 'wp' },
      { page: 'wordpress/hooks/a.mdx', version: '1.2.0', base: 'ss' },
    ]);
  });

  test('a missing content folder has no pages', async () => {
    expect(await new ContentFiles('/no/such/content').pages()).toEqual([]);
  });
});
