import { describe, expect, test } from 'bun:test';
import { mkdtempSync, readFileSync } from 'node:fs';
import { tmpdir } from 'node:os';
import { join } from 'node:path';
import { RunnerCrate } from '../src/index.ts';

const fake = join(import.meta.dir, '..', '..', '..', 'tests', 'fixtures', 'fake-runner', 'speedyspec-guide-examples');

describe('RunnerCrate', () => {
  test('runs a side with a manifest whose examples carry what to load', async () => {
    const log = join(mkdtempSync(join(tmpdir(), 'runner-')), 'log');
    process.env.FAKE_RUNNER_LOG = log;
    const runs = await new RunnerCrate(fake).run('wordpress', [{ id: 'hooks/add_filter/a', file: '/x/a.php', load: ['wp-includes/plugin.php'], setup: '/s/setup.php', multisite: true }], '/wp');
    delete process.env.FAKE_RUNNER_LOG;
    expect(runs).toEqual([{ id: 'hooks/add_filter/a', side: 'wordpress', output: '', return: '20', error: null }]);
    const call = JSON.parse(readFileSync(log, 'utf8').trim());
    expect(call.args.slice(0, 3)).toEqual(['run', '--side', 'wordpress']);
    expect(call.manifest).toEqual({ wordpressDir: '/wp', examples: [{ id: 'hooks/add_filter/a', file: '/x/a.php', load: ['wp-includes/plugin.php'], setup: '/s/setup.php', multisite: true }] });
  });

  test('reflects a mode', async () => {
    const symbols = await new RunnerCrate(fake).reflect('runtime');
    expect(symbols.map((s) => s.id)).toEqual(['function:strlen', 'function:add_filter']);
  });

  test('a failing runner rejects with its stderr', async () => {
    process.env.FAKE_RUNNER_FAIL = '1';
    await expect(new RunnerCrate(fake).reflect('baseline')).rejects.toThrow('the runner broke');
    delete process.env.FAKE_RUNNER_FAIL;
  });
});

describe('a runner that hangs', () => {
  test('is killed after the timeout, and the call rejects saying so', async () => {
    process.env.FAKE_RUNNER_SLEEP = '5000';
    const started = Date.now();
    await expect(new RunnerCrate(fake, 300).reflect('baseline')).rejects.toThrow('timed out after 300 ms');
    delete process.env.FAKE_RUNNER_SLEEP;
    expect(Date.now() - started).toBeLessThan(3000);
  });
});
