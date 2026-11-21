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

  test('reads <Ev/> citations', async () => {
    const c = new ContentFiles(content({ 'wordpress/hooks/add_filter.mdx': 'Returns true. <Ev scenario="add_filter_returns_true"/>\n' }));
    expect(await c.citations()).toEqual([{ page: 'wordpress/hooks/add_filter.mdx', section: 'wordpress', seam: 'hooks', citation: { kind: 'scenario', area: 'hooks', name: 'add_filter_returns_true' } }]);
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
