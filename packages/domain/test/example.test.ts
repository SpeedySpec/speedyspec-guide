import { describe, expect, test } from 'bun:test';
import { compareExample, type ExampleOutcome, type ExampleRun } from '../src/index.ts';

const outcome = (o: Partial<ExampleOutcome> = {}): ExampleOutcome => ({ output: '', return: '20', error: null, ...o });
const run = (o: Partial<ExampleOutcome> = {}): ExampleRun => ({ id: 'hooks/add_filter/a', side: 'runtime', ...outcome(o) });

describe('compareExample', () => {
  test('equal outcomes pass', () => {
    expect(compareExample(outcome(), run())).toEqual({ id: 'hooks/add_filter/a', side: 'runtime', passed: true, actual: outcome(), expected: outcome() });
  });
  test('a different return fails', () => {
    expect(compareExample(outcome(), run({ return: '55' })).passed).toBe(false);
  });
  test('a different output fails', () => {
    expect(compareExample(outcome(), run({ output: 'x' })).passed).toBe(false);
  });
  test('an expected error ending in * matches by prefix', () => {
    const expected = outcome({ return: null, error: 'Error: Call to undefined function*' });
    expect(compareExample(expected, run({ return: null, error: 'Error: Call to undefined function x()' })).passed).toBe(true);
    expect(compareExample(expected, run({ return: null, error: 'TypeError: x' })).passed).toBe(false);
  });
  test('a * anywhere but the end is literal', () => {
    const expected = outcome({ return: null, error: 'a*b' });
    expect(compareExample(expected, run({ return: null, error: 'aXb' })).passed).toBe(false);
    expect(compareExample(expected, run({ return: null, error: 'a*b' })).passed).toBe(true);
  });
});
