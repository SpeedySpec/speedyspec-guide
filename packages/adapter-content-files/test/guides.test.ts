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
      { file: 'guides/contributing/speedyspec/02-port.mdx', kind: 'contributing', part: 'speedyspec', slug: 'port', order: 2, title: 'Port', summary: 'About Port.', examples: [], symbols: [], citations: [] },
      { file: 'guides/path/01-first.mdx', kind: 'path', slug: 'first', order: 1, title: 'First', summary: 'About First.', examples: [], symbols: [], citations: [] },
      { file: 'guides/topics/options.mdx', kind: 'topic', slug: 'options', seam: 'options', title: 'Options', summary: 'About Options.', examples: [], symbols: [], citations: [] },
    ]);
  });

  test('test_maps_theme_guides', async () => {
    const guides = await new GuideFiles(content({ 'guides/themes/02-theme-json.mdx': front('theme.json'), 'guides/themes/01-finding-templates.mdx': front('Finding templates') })).guides();
    expect(guides.map((g) => [g.kind, g.slug, g.order])).toEqual([['theme', 'finding-templates', 1], ['theme', 'theme-json', 2]]);
  });

  test('test_collects_examples_and_symbols', async () => {
    const [guide] = await new GuideFiles(content({
      'guides/path/01-first.mdx': front('First') + 'Read it with <Sym id="function:get_option" />.\n\n<Example id="options/get_option/basic" />\n',
    })).guides();
    expect(guide!.examples).toEqual(['options/get_option/basic']);
    expect(guide!.symbols).toEqual(['function:get_option']);
  });

  test('test_collects_citations', async () => {
    const [guide] = await new GuideFiles(content({
      'guides/contributing/wordpress/01-change.mdx': front('Change') + 'It filters first. <Ev source="wp:wp-includes/option.php#L132-L132" hash="abc"/>\n',
    })).guides();
    expect(guide!.citations).toEqual([{ kind: 'source', base: 'wp', file: 'wp-includes/option.php', from: 132, to: 132, hash: 'abc' }]);
  });

  test('test_tags_inside_code_are_not_read', async () => {
    const [guide] = await new GuideFiles(content({
      'guides/contributing/speedyspec/01-tags.mdx': front('Tags')
        + 'Cite with `<Ev example="<seam>/<symbol>/<name>"/>` or embed with `<Example id="x/y/z" />`.\n\n'
        + '```mdx\n<Sym id="function:nope" />\n<Ev source="wp:nope.php#L1"/>\n```\n\n'
        + 'A real one: <Sym id="function:get_option" /> <Example id="options/get_option/missing" />\n',
    })).guides();
    expect(guide!.examples).toEqual(['options/get_option/missing']);
    expect(guide!.symbols).toEqual(['function:get_option']);
    expect(guide!.citations).toEqual([]);
  });

  test('test_code_edge_cases_are_skipped_without_hiding_real_tags', async () => {
    const [guide] = await new GuideFiles(content({
      'guides/path/01-edges.mdx': front('Edges')
        + '````md\n```php\n<Sym id="function:inside_fence" />\n```\n````\n\n'
        + '1. A step:\n\n   ```php\n   <Sym id="function:indented_fence" />\n   ```\n\n'
        + 'An escaped \\` backtick, then a real <Sym id="function:get_option" />, and `code`.\n',
    })).guides();
    expect(guide!.symbols).toEqual(['function:get_option']);
  });

  test('test_speedyspec_note_ids_are_symbols', async () => {
    const [guide] = await new GuideFiles(content({
      'guides/path/01-first.mdx': front('First') + 'It works there too. <OnSpeedySpecNote id="function:add_filter" />\n',
    })).guides();
    expect(guide!.symbols).toEqual(['function:add_filter']);
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
