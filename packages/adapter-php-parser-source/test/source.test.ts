import { describe, expect, test } from 'bun:test';
import { join } from 'node:path';
import { PhpParserSource } from '../src/index.ts';

const fixtures = join(import.meta.dir, '..', '..', '..', 'tests', 'fixtures');

describe('PhpParserSource', () => {
  test('extracts an inventory whose edges all cite source lines', async () => {
    const inv = await new PhpParserSource().extract(join(fixtures, 'php'), 'wp', '7.1.5');
    expect(inv.base).toBe('wp');
    expect(inv.version).toBe('7.1.5');
    expect(inv.symbols.some((s) => s.id === 'function:add_filter')).toBe(true);
    expect(inv.edges.length).toBeGreaterThan(0);
    expect(inv.edges.every((e) => e.at?.kind === 'source')).toBe(true);
  });

  test('a missing root is refused with the root and the extractor message', async () => {
    const root = join(fixtures, 'no-such-dir');
    await expect(new PhpParserSource().extract(root, 'wp', '7.1.5')).rejects.toThrow(/no-such-dir[\s\S]*not a directory/);
  });
});

describe('PhpParserSource with stub files', () => {
  test('passes the stub files to the extractor', async () => {
    const inv = await new PhpParserSource('php', ['noop.php']).extract(join(fixtures, 'php'), 'wp', '7.1.5');
    expect(inv.symbols.find((s) => s.id === 'function:apply_filters')?.file).toBe('plugin.php');
  });
});
