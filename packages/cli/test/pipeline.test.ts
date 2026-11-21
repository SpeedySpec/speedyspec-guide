import { describe, expect, test } from 'bun:test';
import { cpSync, existsSync, mkdirSync, mkdtempSync, readFileSync } from 'node:fs';
import { tmpdir } from 'node:os';
import { join } from 'node:path';

const repo = join(import.meta.dir, '..', '..', '..');
const fixtures = join(repo, 'tests', 'fixtures');

describe('bun run guide all --offline', () => {
  test('writes every stage output and fails on the bad citation', async () => {
    const work = mkdtempSync(join(tmpdir(), 'pipeline-'));
    cpSync(join(fixtures, 'pipeline'), work, { recursive: true });
    cpSync(join(repo, 'sources.json'), join(work, 'sources.json'));
    await Bun.write(join(work, 'guide.config.json'), JSON.stringify({ requireAllAssigned: false, stubFiles: ['noop.php'] }));
    const p = Bun.spawnSync(['bun', join(repo, 'packages', 'cli', 'src', 'main.ts'), 'all', '--offline'], {
      cwd: work,
      env: { ...process.env, GUIDE_WORDPRESS_DIR: join(fixtures, 'php'), GUIDE_SERVER_DIR: join(fixtures, 'server') },
    });
    const out = p.stdout.toString() + p.stderr.toString();
    for (const f of ['inventory-wp', 'assignment', 'graph', 'cycles', 'compat', 'validation']) {
      // No fork stage any more: the guide doesn't read packages/.
      expect(existsSync(join(work, 'generated', 'fork.json'))).toBe(false);
      expect(existsSync(join(work, 'generated', `${f}.json`))).toBe(true);
    }
    const graph = JSON.parse(readFileSync(join(work, 'generated', 'graph.json'), 'utf8'));
    expect(graph.crossSeam).toContainEqual(expect.objectContaining({ from: 'function:update_option', to: 'function:apply_filters', fromSeam: 'options', toSeam: 'hooks' }));
    // An unported seam with a compat area of its name gets an evidence index and its compat release.
    const compat = JSON.parse(readFileSync(join(work, 'generated', 'compat.json'), 'utf8'));
    expect(compat).toEqual({ areas: { hooks: '7.1.5', options: '7.1.5' } });
    const index = JSON.parse(readFileSync(join(work, 'generated', 'evidence-index.json'), 'utf8'));
    expect(index.options['function:update_option'].scenarios).toEqual(['get_with_pre_option']);
    const validation = JSON.parse(readFileSync(join(work, 'generated', 'validation.json'), 'utf8'));
    expect(validation).toEqual([expect.objectContaining({ rule: 'CitationExists', where: 'wordpress/hooks/add_filter.mdx' })]);
    expect(out).toContain('CitationExists wordpress/hooks/add_filter.mdx: scenario hooks/does_not_exist does not exist');
    expect(p.exitCode).toBe(1);
  });

  test('an unknown stage is refused with the list of stages', () => {
    const p = Bun.spawnSync(['bun', join(repo, 'packages', 'cli', 'src', 'main.ts'), 'nope']);
    expect(p.exitCode).toBe(2);
    expect(p.stderr.toString()).toContain('extract, assign, graph, history, examples, reflect, runtime-history, conversion, crates, coverage, evidence, validate, all');
  });
});

describe('the examples, reflect and runtime-history stages', () => {
  async function work(): Promise<string> {
    const dir = mkdtempSync(join(tmpdir(), 'pipeline-examples-'));
    cpSync(join(fixtures, 'pipeline'), dir, { recursive: true });
    cpSync(join(repo, 'sources.json'), join(dir, 'sources.json'));
    await Bun.write(join(dir, 'guide.config.json'), JSON.stringify({ requireAllAssigned: false, stubFiles: ['noop.php'] }));
    cpSync(join(fixtures, 'examples-seams', 'hooks', 'examples'), join(dir, 'seams', 'hooks', 'examples'), { recursive: true });
    return dir;
  }
  const env = (extra: Record<string, string> = {}) => ({ ...process.env, GUIDE_WORDPRESS_DIR: join(fixtures, 'php'), GUIDE_SERVER_DIR: join(fixtures, 'server'), ...extra });
  const guide = (dir: string, args: string[], e: Record<string, string | undefined>) => Bun.spawnSync(['bun', join(repo, 'packages', 'cli', 'src', 'main.ts'), ...args], { cwd: dir, env: e });

  test('offline without a runner binary, they are skipped', async () => {
    const dir = await work();
    const p = guide(dir, ['examples', '--offline'], env({ GUIDE_RUNNER: join(dir, 'no-such-binary') }));
    expect(p.exitCode).toBe(0);
    expect(p.stderr.toString()).toContain('no runner binary');
    expect(existsSync(join(dir, 'generated', 'examples.json'))).toBe(false);
  });

  test('online without a runner binary, they fail and say how to build it', async () => {
    const dir = await work();
    const p = guide(dir, ['examples'], env({ GUIDE_RUNNER: join(dir, 'no-such-binary') }));
    expect(p.exitCode).toBe(1);
    expect(p.stderr.toString()).toContain('bun run runner:build');
  });

  test('with a runner they write the results, the runtime API and its history', async () => {
    const dir = await work();
    const fake = join(fixtures, 'fake-runner', 'speedyspec-guide-examples');
    // The fixture examples include broken files on purpose, so the examples stage reports them and fails.
    const examples = guide(dir, ['examples', '--offline'], env({ GUIDE_RUNNER: fake }));
    expect(examples.exitCode).toBe(1);
    expect(examples.stdout.toString()).toContain('ExampleHasRun');
    for (const stage of ['reflect', 'runtime-history']) {
      const p = guide(dir, [stage, '--offline'], env({ GUIDE_RUNNER: fake }));
      expect(p.exitCode, p.stderr.toString()).toBe(0);
    }
    const read = (f: string) => JSON.parse(readFileSync(join(dir, 'generated', `${f}.json`), 'utf8'));
    const results = read('examples');
    expect(results.results.find((r: { id: string; side: string }) => r.id === 'hooks/add_filter/a' && r.side === 'runtime')?.passed).toBe(true);
    expect(results.problems.length).toBeGreaterThan(0);
    expect(read('inventory-runtime').map((s: { id: string }) => s.id)).toEqual(['function:add_filter']);
    expect(read('speedyspec-history')).toEqual({ versions: [], symbols: { 'function:add_filter': { since: 'unreleased' } } });
  });

  test('conversion_says_which_wordpress_symbols_are_rust', async () => {
    const dir = await work();
    const fake = join(fixtures, 'fake-runner', 'speedyspec-guide-examples');
    expect(guide(dir, ['conversion', '--offline'], env({ GUIDE_RUNNER: fake })).stderr.toString()).toContain('conversion skipped: no inventory-runtime.json');
    for (const stage of ['extract', 'reflect', 'conversion']) {
      const p = guide(dir, [stage, '--offline'], env({ GUIDE_RUNNER: fake }));
      expect(p.exitCode, p.stderr.toString()).toBe(0);
    }
    const conversion = JSON.parse(readFileSync(join(dir, 'generated', 'conversion.json'), 'utf8'));
    expect(conversion).toEqual({ states: { 'function:add_filter': 'runtime', 'function:update_option': 'ported' } });
  });
});

describe('a failing example', () => {
  test('fails the examples stage, naming it', async () => {
    const dir = mkdtempSync(join(tmpdir(), 'pipeline-failing-'));
    cpSync(join(fixtures, 'pipeline'), dir, { recursive: true });
    cpSync(join(repo, 'sources.json'), join(dir, 'sources.json'));
    await Bun.write(join(dir, 'guide.config.json'), JSON.stringify({ requireAllAssigned: false }));
    const ex = join(dir, 'seams', 'hooks', 'examples', 'add_filter');
    mkdirSync(ex, { recursive: true });
    await Bun.write(join(ex, 'wrong.php'), '<?php return 20;\n');
    await Bun.write(join(ex, 'wrong.expect.json'), JSON.stringify({ sides: ['wordpress'], output: '', return: '21', error: null }));
    const p = Bun.spawnSync(['bun', join(repo, 'packages', 'cli', 'src', 'main.ts'), 'examples', '--offline'], {
      cwd: dir,
      env: { ...process.env, GUIDE_WORDPRESS_DIR: join(fixtures, 'php'), GUIDE_SERVER_DIR: join(fixtures, 'server'), GUIDE_RUNNER: join(fixtures, 'fake-runner', 'speedyspec-guide-examples') },
    });
    expect(p.exitCode).toBe(1);
    expect(p.stdout.toString()).toContain('ExampleHasRun hooks/add_filter/wrong: fails on wordpress: expected return 21, got 20');
  });
});

describe('validating SpeedySpec versions offline', () => {
  test('uses the released versions recorded in speedyspec-history.json', async () => {
    const dir = mkdtempSync(join(tmpdir(), 'pipeline-versions-'));
    cpSync(join(fixtures, 'pipeline'), dir, { recursive: true });
    cpSync(join(repo, 'sources.json'), join(dir, 'sources.json'));
    await Bun.write(join(dir, 'guide.config.json'), JSON.stringify({ requireAllAssigned: false, stubFiles: ['noop.php'] }));
    await Bun.write(join(dir, 'generated', 'speedyspec-history.json'), JSON.stringify({ versions: ['1.0.0'], symbols: {} }));
    await Bun.write(join(dir, 'content', 'speedyspec', 'hooks', 'add_filter.mdx'), '<Changed version="1.0.0"/> <Changed version="1.1.0"/> <Ev scenario="add_filter_returns_true"/>');
    const p = Bun.spawnSync(['bun', join(repo, 'packages', 'cli', 'src', 'main.ts'), 'all', '--offline'], {
      cwd: dir,
      env: { ...process.env, GUIDE_WORDPRESS_DIR: join(fixtures, 'php'), GUIDE_SERVER_DIR: join(fixtures, 'server'), GUIDE_RUNNER: join(dir, 'none') },
    });
    const out = p.stdout.toString();
    expect(out).toContain('VersionHasTag speedyspec/hooks/add_filter.mdx: SpeedySpec 1.1.0');
    expect(out).not.toContain('SpeedySpec 1.0.0');
  });
});
