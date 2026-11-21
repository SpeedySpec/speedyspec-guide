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

describe('a function declared in more than one file', () => {
  test('the declaration with a body wins over an empty stub, and the others are listed', () => {
    expect(sym('function:add_filter')).toMatchObject({ file: 'plugin.php', line: 5, alternates: ['noop.php:3'] });
  });
});

describe('stub files', () => {
  test('a declaration in a named stub file never beats a real one, even with a body', () => {
    const p = Bun.spawnSync(['php', extractor, join(fixtures, 'php'), 'wp', '7.1.5', '--stubs=noop.php']);
    const withStubs: Inventory = JSON.parse(p.stdout.toString());
    expect(withStubs.symbols.find((s) => s.id === 'function:apply_filters')).toMatchObject({ file: 'plugin.php', alternates: ['noop.php:4'] });
  });
});

describe('namespaces', () => {
  test('classes with the same short name in different namespaces stay apart', () => {
    const ns = run(join(fixtures, 'php-ns'));
    const ids = ns.symbols.map((s) => s.id);
    expect(ids).toContain('class:PHPMailer\\PHPMailer\\Exception');
    expect(ids).toContain('class:WpOrg\\Requests\\Exception');
    expect(ids).toContain('method:WpOrg\\Requests\\Exception::getType');
    expect(ids).toContain('function:PHPMailer\\PHPMailer\\helper');
    expect(ns.symbols.find((s) => s.id === 'class:PHPMailer\\PHPMailer\\Exception')?.alternates).toBeUndefined();
  });

  test('calls inside a namespace resolve: new to the namespaced class, a qualified call as written, a builtin to the global function', () => {
    const ns = run(join(fixtures, 'php-ns'));
    const has = (from: string, to: string) => ns.edges.some((e) => e.from === from && e.to === to && e.kind === 'calls');
    expect(has('function:PHPMailer\\PHPMailer\\helper', 'class:PHPMailer\\PHPMailer\\Exception')).toBe(true);
    expect(has('method:WpOrg\\Requests\\Exception::getType', 'function:PHPMailer\\PHPMailer\\helper')).toBe(true);
    expect(has('method:PHPMailer\\PHPMailer\\Exception::errorMessage', 'function:strlen')).toBe(true);
  });
});

describe('old WordPress syntax', () => {
  test('curly string offsets and =& new still parse', () => {
    const old = run(join(fixtures, 'php-old'));
    expect(old.symbols.map((s) => s.id)).toEqual(expect.arrayContaining(['function:old_first_char', 'function:old_by_ref']));
    expect(old.edges.some((e) => e.from === 'function:old_by_ref' && e.to === 'class:WP_Query')).toBe(true);
  });

  test('a file that cannot be parsed is reported in the inventory, not only on stderr', () => {
    const old = run(join(fixtures, 'php-old'));
    expect(old.errors).toEqual([expect.objectContaining({ file: 'broken.php' })]);
    expect(old.errors?.some((e) => e.file === 'old.php')).toBe(false);
  });
});

describe('scopes and callbacks', () => {
  const scope = () => run(join(fixtures, 'php-scope'));

  test('$this, self::class, __CLASS__ and static:: callbacks resolve to the current class', () => {
    const inv = scope();
    const runs = (hook: string, to: string) => inv.edges.some((e) => e.from === hook && e.to === to && e.kind === 'runs');
    expect(runs('action:init', 'method:Registers::on_init')).toBe(true);
    expect(runs('filter:the_title', 'method:Registers::title')).toBe(true);
    expect(runs('filter:the_excerpt', 'method:Registers::excerpt')).toBe(true);
    expect(runs('filter:the_date', 'method:Registers::date')).toBe(true);
  });

  test('a closure registered on a hook is not charged to the function that registers it', () => {
    const inv = scope();
    expect(inv.edges.some((e) => e.from === 'function:a' && e.to === 'function:b')).toBe(false);
    expect(inv.edges.some((e) => e.from === 'function:a' && e.to === 'global:wpdb')).toBe(false);
  });

  test('a closure used in place is still a dependency of its function', () => {
    expect(scope().edges.some((e) => e.from === 'function:a' && e.to === 'function:c' && e.kind === 'calls')).toBe(true);
  });

  test('an unguarded declaration beats a function_exists polyfill', () => {
    expect(scope().symbols.find((s) => s.id === 'function:wp_cache_add_multiple')).toMatchObject({ file: 'cache.php', alternates: ['a-cache-compat.php:3'], pluggable: true });
  });
});

describe('modern syntax next to old syntax', () => {
  test('match, nullsafe and enums parse with the newest grammar', () => {
    const inv = run(join(fixtures, 'php-old'));
    expect(inv.symbols.map((s) => s.id)).toEqual(expect.arrayContaining(['function:new_syntax', 'class:Suit']));
    expect(inv.errors?.some((e) => e.file === 'new.php')).toBe(false);
  });
});
