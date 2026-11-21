import { describe, expect, test } from 'bun:test';
import type { ExampleRunner, ExampleSource } from '@speedyspec-guide/contracts';
import type { Example, GuideSymbol, Seam } from '@speedyspec-guide/domain';
import { runExamples, runtimeApi } from '../src/examples.ts';

const seam: Seam = { id: 'hooks', name: 'Hooks', job: 'j', ported: true, files: [], symbols: [], exclude: [], roles: {}, edges: [], wordpress: ['wp-includes/plugin.php'] };
const example: Example = { id: 'hooks/add_filter/a', seam: 'hooks', symbol: 'add_filter', name: 'a', file: '/x/a.php', sides: ['wordpress', 'runtime'], expect: { output: '', return: '20', error: null } };
const source: ExampleSource = { all: async () => ({ examples: [example], problems: [{ where: '/x/b.php', message: 'has no b.expect.json' }] }) };

function fakeRunner(returns: Record<string, string>) {
  const calls: { side: string; examples: { id: string; file: string; load: string[] }[]; wordpressDir: string }[] = [];
  const runner: ExampleRunner = {
    run: async (side, examples, wordpressDir) => {
      calls.push({ side, examples, wordpressDir });
      return examples.map((e) => ({ id: e.id, side, output: '', return: returns[side] ?? null, error: null }));
    },
    reflect: async (mode) => (mode === 'runtime' ? [sym('function:strlen'), sym('function:add_filter')] : [sym('function:strlen')]),
  };
  return { runner, calls };
}
const sym = (id: string): GuideSymbol => ({ id, kind: 'function', name: id.slice(9), file: 'native', line: 0 });

describe('runExamples', () => {
  test('runs each side once and compares with what was expected', async () => {
    const { runner, calls } = fakeRunner({ wordpress: '20', runtime: '55' });
    const r = await runExamples(source, runner, [seam], '/wp');
    expect(calls.map((c) => c.side)).toEqual(['wordpress', 'runtime']);
    expect(r.results.map((x) => [x.side, x.passed])).toEqual([['wordpress', true], ['runtime', false]]);
  });

  test("a seam's WordPress files are loaded on the WordPress side only", async () => {
    const { runner, calls } = fakeRunner({ wordpress: '20', runtime: '20' });
    await runExamples(source, runner, [seam], '/wp');
    expect(calls[0]).toEqual({ side: 'wordpress', examples: [{ id: example.id, file: '/x/a.php', load: ['wp-includes/plugin.php'] }], wordpressDir: '/wp' });
    expect(calls[1]?.examples[0]?.load).toEqual([]);
  });

  test('records what each example declares', async () => {
    const { runner } = fakeRunner({ wordpress: '20', runtime: '20' });
    expect((await runExamples(source, runner, [seam], '/wp')).declared).toEqual([{ id: example.id, sides: ['wordpress', 'runtime'] }]);
  });

  test("the source's problems pass through", async () => {
    const { runner } = fakeRunner({});
    expect((await runExamples(source, runner, [seam], '/wp')).problems).toEqual([{ where: '/x/b.php', message: 'has no b.expect.json' }]);
  });

  test('a side no example declares is not run', async () => {
    const { runner, calls } = fakeRunner({});
    const wpOnly: ExampleSource = { all: async () => ({ examples: [{ ...example, sides: ['wordpress'] }], problems: [] }) };
    await runExamples(wpOnly, runner, [seam], '/wp');
    expect(calls.map((c) => c.side)).toEqual(['wordpress']);
  });
});

describe('runtimeApi', () => {
  test('includes SpeedySpec classes PHP always has, such as SpeedySpec\\Hooks\\Hook', async () => {
    const hook: GuideSymbol = { id: 'class:SpeedySpec\\Hooks\\Hook', kind: 'class', name: 'SpeedySpec\\Hooks\\Hook', file: 'native', line: 0 };
    const method: GuideSymbol = { id: 'method:SpeedySpec\\Hooks\\Hook::add', kind: 'method', name: 'add', file: 'native', line: 0 };
    const runner: ExampleRunner = { run: async () => [], reflect: async () => [sym('function:strlen'), hook, method] };
    expect((await runtimeApi(runner)).map((s) => s.id)).toEqual([hook.id, method.id]);
  });

  test("is the runtime's symbols that plain PHP doesn't have", async () => {
    expect((await runtimeApi(fakeRunner({}).runner)).map((s) => s.id)).toEqual(['function:add_filter']);
  });
});
