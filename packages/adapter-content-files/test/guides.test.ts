import { describe, expect, test } from 'bun:test';
import { mkdirSync, mkdtempSync, writeFileSync } from 'node:fs';
import { tmpdir } from 'node:os';
import { dirname, join } from 'node:path';
import { GuideFiles } from '../src/index.ts';

function content(files: Record<string, string>): string {
  const dir = mkdtempSync(join(tmpdir(), 'guides-'));
  for (const [path, body] of Object.entries(files)) {
    mkdirSync(dirname(join(dir, path)), { recursive: true });
    writeFileSync(join(dir, path), body);
  }
  return dir;
}

const front = (title: string) => `---\ntitle: ${title}\nsummary: About ${title}.\n---\n\n`;

describe('GuideFiles', () => {
  test('test_maps_each_kind', async () => {
    const guides = await new GuideFiles(content({
      'guides/path/01-first.mdx': front('First'),
      'guides/topics/options.mdx': front('Options'),
      'guides/contributing/speedyspec/02-port.mdx': front('Port'),
    })).guides();
    expect(guides).toEqual([
      { file: 'guides/contributing/speedyspec/02-port.mdx', kind: 'contributing', part: 'speedyspec', slug: 'port', order: 2, title: 'Port', summary: 'About Port.', examples: [], symbols: [] },
      { file: 'guides/path/01-first.mdx', kind: 'path', slug: 'first', order: 1, title: 'First', summary: 'About First.', examples: [], symbols: [] },
      { file: 'guides/topics/options.mdx', kind: 'topic', slug: 'options', seam: 'options', title: 'Options', summary: 'About Options.', examples: [], symbols: [] },
    ]);
  });

  test('test_collects_examples_and_symbols', async () => {
    const [guide] = await new GuideFiles(content({
      'guides/path/01-first.mdx': front('First') + 'Read it with <Sym id="function:get_option" />.\n\n<Example id="options/get_option/basic" />\n',
    })).guides();
    expect(guide!.examples).toEqual(['options/get_option/basic']);
    expect(guide!.symbols).toEqual(['function:get_option']);
  });

  test('test_missing_front_matter_is_empty_strings', async () => {
    const [guide] = await new GuideFiles(content({ 'guides/path/first.mdx': 'No front matter.\n' })).guides();
    expect(guide).toMatchObject({ title: '', summary: '', slug: 'first' });
    expect(guide!.order).toBeUndefined();
  });

  test('no guides folder gives no guides', async () => {
    expect(await new GuideFiles(content({})).guides()).toEqual([]);
  });
});
