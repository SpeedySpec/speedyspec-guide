import { beforeAll, describe, expect, test } from 'bun:test';
import { join } from 'node:path';
import type { Edge, Inventory } from '@speedyspec-guide/domain';

const extractor = join(import.meta.dir, '..', 'extractor', 'extract.php');
const fixtures = join(import.meta.dir, '..', '..', '..', 'tests', 'fixtures');

function run(root: string): Inventory {
  const p = Bun.spawnSync(['php', extractor, root, 'wp', '7.1.5']);
  if (p.exitCode !== 0) throw new Error(p.stderr.toString());
  return JSON.parse(p.stdout.toString());
}

let inv: Inventory;
beforeAll(() => {
  inv = run(join(fixtures, 'php'));
});

const sym = (id: string) => inv.symbols.find((s) => s.id === id);
const edge = (from: string, to: string, kind: Edge['kind']) => inv.edges.find((e) => e.from === from && e.to === to && e.kind === kind);

describe('extract.php', () => {
  test('reports base and version', () => {
    expect(inv.base).toBe('wp');
    expect(inv.version).toBe('7.1.5');
  });

  test('a function with its exact signature and no comments', () => {
    expect(sym('function:add_filter')).toMatchObject({
      kind: 'function', name: 'add_filter', file: 'plugin.php', line: 5,
      signature: 'add_filter($hook_name, $callback, $priority = 10, $accepted_args = 1)',
    });
  });

  test('a class and its methods, with visibility and static', () => {
    expect(sym('class:WP_Hook')).toMatchObject({ kind: 'class', signature: 'final class WP_Hook implements ArrayAccess' });
    expect(sym('method:WP_Hook::apply_filters')).toMatchObject({ kind: 'method', signature: 'public apply_filters($value, $args)' });
    expect(sym('method:WP_Hook::build_preinitialized_hooks')?.signature).toBe('public static build_preinitialized_hooks($filters)');
  });

  test('a global named in a global statement, and the function writing it', () => {
    expect(sym('global:wp_filter')).toMatchObject({ kind: 'global', file: 'plugin.php', line: 6 });
    expect(edge('function:add_filter', 'global:wp_filter', 'writes')).toBeDefined();
    expect(edge('function:apply_filters', 'global:wp_filter', 'reads')).toBeDefined();
    expect(edge('function:apply_filters', 'global:wp_filter', 'writes')).toBeUndefined();
  });

  test('$GLOBALS assignment is a write to that global', () => {
    expect(sym('global:wp_options_cache')).toBeDefined();
    expect(edge('function:update_option', 'global:wp_options_cache', 'writes')).toBeDefined();
  });

  test('a constant from define()', () => {
    expect(sym('constant:WP_FIXTURE')).toMatchObject({ kind: 'constant', file: 'dynamic.php' });
  });

  test('a pluggable function declared twice is one symbol', () => {
    const all = inv.symbols.filter((s) => s.id === 'function:wp_mail');
    expect(all).toHaveLength(1);
    expect(all[0]).toMatchObject({ pluggable: true, line: 3 });
  });

  test('calls and new, cited by line', () => {
    expect(edge('function:add_filter', 'class:WP_Hook', 'calls')?.at).toEqual({ kind: 'source', base: 'wp', file: 'plugin.php', from: 8, to: 8 });
    expect(edge('function:update_option', 'function:wpautop', 'calls')).toBeDefined();
  });

  test('dynamic hook names become templates', () => {
    expect(edge('function:update_option', 'filter:pre_update_option_{$option}', 'fires')).toBeDefined();
    expect(sym('filter:pre_update_option_{$option}')).toMatchObject({ kind: 'filter', dynamic: true });
    expect(edge('function:update_option', "filter:{$meta_type}_{$args['type']}", 'fires')).toBeDefined();
    expect(edge('function:update_option', 'action:updated_option', 'fires')).toBeDefined();
    expect(sym('action:updated_option')?.dynamic).toBeFalsy();
  });

  test('a hook name built with a function call is unresolved, not dropped', () => {
    const u = inv.unresolved.find((x) => x.code === "'x_' . get_post_type()");
    expect(u).toMatchObject({ from: 'file:plugin.php' });
  });

  test('core registrations make runs edges', () => {
    expect(edge('filter:the_content', 'function:wpautop', 'runs')).toBeDefined();
    expect(edge('filter:b', 'method:WP_Hook::build_preinitialized_hooks', 'runs')).toBeDefined();
    expect(edge('action:c', 'method:Foo::bar', 'runs')).toBeDefined();
  });

  test('closures, arrow functions and $this callbacks make no runs edge', () => {
    for (const hook of ['filter:a', 'filter:d', 'filter:e']) {
      expect(inv.edges.filter((e) => e.from === hook && e.kind === 'runs')).toEqual([]);
    }
  });

  test('variable calls are unresolved', () => {
    const codes = inv.unresolved.map((u) => u.code);
    expect(codes).toContain('call_user_func($callback)');
    expect(codes).toContain('$fn()');
    expect(codes).toContain('$obj->{$method}()');
  });

  test('the same code with different comments and spacing hashes the same', () => {
    const a = run(join(fixtures, 'php-hash', 'a')).symbols.find((s) => s.id === 'function:same_code');
    const b = run(join(fixtures, 'php-hash', 'b')).symbols.find((s) => s.id === 'function:same_code');
    expect(a?.hash).toMatch(/^[0-9a-f]{64}$/);
    expect(a?.hash).toBe(b?.hash);
  });
});
