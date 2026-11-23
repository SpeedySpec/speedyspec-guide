import { describe, expect, test } from 'bun:test';
import { cpSync, mkdtempSync, rmSync } from 'node:fs';
import { tmpdir } from 'node:os';
import { join } from 'node:path';
import { SeamFiles } from '../src/index.ts';

const fixtures = join(import.meta.dir, '..', '..', '..', 'tests', 'fixtures', 'seams');

function only(...names: string[]): string {
  const dir = mkdtempSync(join(tmpdir(), 'seams-'));
  for (const n of names) cpSync(join(fixtures, n), join(dir, n), { recursive: true });
  return dir;
}

describe('SeamFiles', () => {
  test('reads every seam, named by its folder, with defaults and parsed edges', async () => {
    const dir = only('a', 'b');
    const seams = await new SeamFiles(dir).all();
    rmSync(dir, { recursive: true });
    expect(seams.map((s) => s.id)).toEqual(['a', 'b']);
    expect(seams[0]).toMatchObject({ name: 'A', ported: false, files: ['a/*.php'], exclude: ['function:excluded'], roles: { main: ['function:in_a'] } });
    expect(seams[0]?.edges[0]).toEqual({ from: 'function:in_a', to: 'global:g', kind: 'writes', at: { kind: 'source', base: 'wp', file: 'a/x.php', from: 3, to: 3 } });
    expect(seams[1]).toMatchObject({ ported: true, symbols: ['function:shared'], exclude: [], roles: {}, edges: [], wordpress: [] });
  });

  test('an_elsewhere_entry_names_an_api_documented_elsewhere', async () => {
    const dir = only('elsewhere', 'a');
    const [a, e] = await new SeamFiles(dir).all();
    rmSync(dir, { recursive: true });
    expect(a?.elsewhere).toEqual([]);
    expect(e?.elsewhere).toEqual([
      { name: 'The Sodium extension', docs: 'https://www.php.net/manual/en/book.sodium.php', files: ['e/vendor/**'], note: "A polyfill of the extension's API." },
    ]);
  });

  test('an_elsewhere_entry_needs_a_link', async () => {
    const dir = only('elsewhere-broken');
    await expect(new SeamFiles(dir).all()).rejects.toThrow('elsewhere-broken/seam.yaml: elsewhere entry 1 needs a name, an https docs link and files');
    rmSync(dir, { recursive: true });
  });

  test('an_unrunnable_entry_names_a_symbol_and_why', async () => {
    const dir = only('unrunnable', 'a');
    const [a, u] = await new SeamFiles(dir).all();
    rmSync(dir, { recursive: true });
    expect(a?.unrunnable).toEqual([]);
    expect(u?.unrunnable).toEqual([{ symbol: 'function:ends_with_exit', reason: 'It ends the request with exit.' }]);
  });

  test('an_unrunnable_entry_needs_a_reason', async () => {
    const dir = only('unrunnable-broken');
    await expect(new SeamFiles(dir).all()).rejects.toThrow('unrunnable-broken/seam.yaml: unrunnable entry 1 needs a symbol and a reason');
    rmSync(dir, { recursive: true });
  });

  test('fork_fields_are_refused', async () => {
    const dir = only('forked');
    await expect(new SeamFiles(dir).all()).rejects.toThrow("forked/seam.yaml: forkPackages is no longer supported; list the seam's WordPress files");
    rmSync(dir, { recursive: true });
  });

  test('a dependency state carries its state and citation', async () => {
    const dir = only('states');
    const [s] = await new SeamFiles(dir).all();
    rmSync(dir, { recursive: true });
    expect(s?.dependencies).toEqual({ 'function:t': { state: 'port', cite: { kind: 'source', base: 'ss', file: 'crates/x/src/a.rs', from: 1, to: 2, hash: 'abc' } } });
  });

  test('state_without_a_citation_fails', async () => {
    const dir = only('stateless');
    await expect(new SeamFiles(dir).all()).rejects.toThrow(/stateless\/seam\.yaml.*function:t.*cite/);
    rmSync(dir, { recursive: true });
  });

  test('a_setup_file_is_read_as_an_absolute_path', async () => {
    const dir = only('setup');
    const [s] = await new SeamFiles(dir).all();
    expect(s?.setup).toBe(join(dir, 'setup', 'setup.php'));
    expect(s?.mysql).toBe(true);
    rmSync(dir, { recursive: true });
  });

  test('a_missing_setup_file_is_refused', async () => {
    const dir = only('setup-missing');
    await expect(new SeamFiles(dir).all()).rejects.toThrow('setup-missing/seam.yaml: setup file missing.php does not exist');
    rmSync(dir, { recursive: true });
  });

  test('a_seam_named_conversion_is_refused_as_a_route', async () => {
    const dir = mkdtempSync(join(tmpdir(), 'seams-'));
    cpSync(join(fixtures, 'a'), join(dir, 'conversion'), { recursive: true });
    await expect(new SeamFiles(dir).all()).rejects.toThrow('seams/conversion: conversion is reserved for a route');
    rmSync(dir, { recursive: true });
  });

  test('packages_is_refused', async () => {
    const dir = only('packaged');
    await expect(new SeamFiles(dir).all()).rejects.toThrow("packaged/seam.yaml: packages is no longer supported; SpeedySpec doesn't ship the PHP packages/ tree");
    rmSync(dir, { recursive: true });
  });

  test('a seam missing its job is refused, naming the file and field', async () => {
    const dir = only('broken');
    await expect(new SeamFiles(dir).all()).rejects.toThrow(/broken\/seam\.yaml.*job/);
    rmSync(dir, { recursive: true });
  });
});
