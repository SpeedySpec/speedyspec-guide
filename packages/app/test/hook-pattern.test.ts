import { describe, expect, test } from 'bun:test';
import { hookPattern } from '../src/hook-pattern.ts';

describe('hookPattern', () => {
  test('each variable part matches one or more characters', () => {
    expect(hookPattern('{$meta_type}_{$option}').test('post_title')).toBe(true);
    expect(hookPattern('{$meta_type}_{$option}').test('_title')).toBe(false);
  });
  test('array and property parts are variables too', () => {
    expect(hookPattern("pre_{$args['type']}_{$o->p}").test('pre_x_y')).toBe(true);
  });
  test('literal text is escaped', () => {
    expect(hookPattern('a.b_{$x}').test('aXb_1')).toBe(false);
    expect(hookPattern('a.b_{$x}').test('a.b_1')).toBe(true);
  });
  test('the whole name must match', () => {
    expect(hookPattern('update_option_{$option}').test('pre_update_option_blogname')).toBe(false);
  });
});
