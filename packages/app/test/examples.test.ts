import { describe, expect, test } from 'bun:test';
import type { ExampleRunner, ExampleSource } from '@speedyspec-guide/contracts';
import type { Example, GuideSymbol, Seam } from '@speedyspec-guide/domain';
import { runExamples, runtimeApi } from '../src/examples.ts';

const seam: Seam = { id: 'hooks', name: 'Hooks', job: 'j', ported: true, files: [], symbols: [], exclude: [], elsewhere: [], roles: {}, edges: [], wordpress: ['wp-includes/plugin.php'] };
const example: Example = { id: 'hooks/add_filter/a', seam: 'hooks', symbol: 'add_filter', name: 'a', file: '/x/a.php', sides: ['wordpress', 'runtime'], multisite: false, expect: { output: '', return: '20', error: null } };
const source: ExampleSource = { all: async () => ({ examples: [example], problems: [{ where: '/x/b.php', message: 'has no b.expect.json' }] }) };

function fakeRunner(returns: Record<string, string>) {
  const calls: { side: string; examples: { id: string; file: string; load: string[]; setup: string | null; multisite: boolean }[]; wordpressDir: string }[] = [];
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
    const r = await runExamples(source, runner, [seam], '/wp', null);
    expect(calls.map((c) => c.side)).toEqual(['wordpress', 'runtime']);
    expect(r.results.map((x) => [x.side, x.passed])).toEqual([['wordpress', true], ['runtime', false]]);
  });

  test("a seam's WordPress files are loaded on the WordPress side only", async () => {
    const { runner, calls } = fakeRunner({ wordpress: '20', runtime: '20' });
    await runExamples(source, runner, [seam], '/wp', null);
    expect(calls[0]).toEqual({ side: 'wordpress', examples: [{ id: example.id, file: '/x/a.php', load: ['wp-includes/plugin.php'], setup: null, multisite: false }], wordpressDir: '/wp' });
    expect(calls[1]?.examples[0]?.load).toEqual([]);
  });

  test('records what each example declares', async () => {
    const { runner } = fakeRunner({ wordpress: '20', runtime: '20' });
    expect((await runExamples(source, runner, [seam], '/wp', null)).declared).toEqual([{ id: example.id, sides: ['wordpress', 'runtime'] }]);
  });

  test("the source's problems pass through", async () => {
    const { runner } = fakeRunner({});
    expect((await runExamples(source, runner, [seam], '/wp', null)).problems).toEqual([{ where: '/x/b.php', message: 'has no b.expect.json' }]);
  });

  test('a side no example declares is not run', async () => {
    const { runner, calls } = fakeRunner({});
    const wpOnly: ExampleSource = { all: async () => ({ examples: [{ ...example, sides: ['wordpress'] }], problems: [] }) };
    await runExamples(wpOnly, runner, [seam], '/wp', null);
    expect(calls.map((c) => c.side)).toEqual(['wordpress']);
  });
});

describe('a seam with a setup file', () => {
  const options: Seam = { ...seam, id: 'options', ported: false, setup: '/seams/options/setup.php', mysql: true };
  const ms: Example = { ...example, id: 'options/get_option/ms', seam: 'options', symbol: 'get_option', sides: ['wordpress'], multisite: true };
  const msSource: ExampleSource = { all: async () => ({ examples: [ms], problems: [] }) };

  test('needs_a_mysql_url_before_running_anything', async () => {
    const { runner, calls } = fakeRunner({});
    await expect(runExamples(msSource, runner, [options], '/wp', null)).rejects.toThrow("the options seam's examples need a MySQL database: set GUIDE_MYSQL_URL (see README)");
    expect(calls).toEqual([]);
  });

  test('passes_its_setup_and_multisite_flag_on_the_wordpress_side', async () => {
    const { runner, calls } = fakeRunner({ wordpress: '20' });
    await runExamples(msSource, runner, [options], '/wp', 'mysql://u:p@h:1/d');
    expect(calls[0]?.examples[0]).toMatchObject({ setup: '/seams/options/setup.php', multisite: true });
  });

  test('a_setup_file_without_mysql_needs_no_mysql_url', async () => {
    const { runner, calls } = fakeRunner({ wordpress: '20' });
    const cache: Seam = { ...options, id: 'object-cache', mysql: false };
    await runExamples({ all: async () => ({ examples: [{ ...ms, seam: 'object-cache', multisite: false }], problems: [] }) }, runner, [cache], '/wp', null);
    expect(calls[0]?.examples[0]?.setup).toBe('/seams/options/setup.php');
  });

  test('a_run_without_such_a_seam_needs_no_mysql_url', async () => {
    const { runner } = fakeRunner({ wordpress: '20', runtime: '20' });
    expect((await runExamples(source, runner, [seam, options], '/wp', null)).results).toHaveLength(2);
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
