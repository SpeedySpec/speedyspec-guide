import { describe, expect, test } from 'bun:test';
import type { GuideSymbol } from '@speedyspec-guide/domain';
import { conversionStates } from '../src/conversion.ts';

const sym = (id: string): GuideSymbol => ({ id, kind: id.slice(0, id.indexOf(':')) as GuideSymbol['kind'], name: id.slice(id.indexOf(':') + 1), file: 'x.php', line: 1 });

describe('conversionStates', () => {
  const wordpress = ['function:add_filter', 'function:get_option', 'function:wp_insert_post', 'filter:option_{$option}', 'class:wpdb', 'method:wpdb::query', 'constant:OBJECT'].map(sym);
  const states = conversionStates(
    wordpress,
    new Set(['function:add_filter', 'function:get_option']),
    new Set(['function:get_option', 'filter:option_{$option}', 'class:wpdb', 'method:wpdb::query', 'constant:OBJECT', 'function:SpeedySpec\\WpOptions\\Native\\get']),
  );

  test('a_symbol_the_runtime_registers_is_rust_in_the_runtime', () => {
    expect(states['function:add_filter']).toBe('runtime');
    expect(states['function:get_option']).toBe('runtime');
  });
  test('a_symbol_only_a_port_declares_is_rust_not_in_the_runtime_yet', () => {
    expect(states['class:wpdb']).toBe('ported');
    expect(states['method:wpdb::query']).toBe('ported');
    expect(states['constant:OBJECT']).toBe('ported');
  });
  test('php_symbols_hooks_and_ids_outside_wordpress_get_no_state', () => {
    expect(states['function:wp_insert_post']).toBeUndefined();
    expect(states['filter:option_{$option}']).toBeUndefined();
    expect(states['function:SpeedySpec\\WpOptions\\Native\\get']).toBeUndefined();
    expect(Object.keys(states).sort()).toEqual(['class:wpdb', 'constant:OBJECT', 'function:add_filter', 'function:get_option', 'method:wpdb::query']);
  });
});
