import { describe, expect, test } from 'bun:test';
import { cpSync, existsSync, mkdtempSync, readFileSync } from 'node:fs';
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
      env: { ...process.env, GUIDE_WORDPRESS_DIR: join(fixtures, 'php'), GUIDE_FORK_DIR: join(fixtures, 'php'), GUIDE_SERVER_DIR: join(fixtures, 'server') },
    });
    const out = p.stdout.toString() + p.stderr.toString();
    for (const f of ['inventory-wp', 'inventory-ss', 'fork', 'assignment', 'graph', 'cycles', 'validation']) {
      expect(existsSync(join(work, 'generated', `${f}.json`))).toBe(true);
    }
    const graph = JSON.parse(readFileSync(join(work, 'generated', 'graph.json'), 'utf8'));
    expect(graph.crossSeam).toContainEqual(expect.objectContaining({ from: 'function:update_option', to: 'function:apply_filters', fromSeam: 'options', toSeam: 'hooks' }));
    const fork = JSON.parse(readFileSync(join(work, 'generated', 'fork.json'), 'utf8'));
    expect(fork['function:add_filter']).toBe('same');
    const validation = JSON.parse(readFileSync(join(work, 'generated', 'validation.json'), 'utf8'));
    expect(validation).toEqual([expect.objectContaining({ rule: 'CitationExists', where: 'wordpress/hooks/add_filter.mdx' })]);
    expect(out).toContain('CitationExists wordpress/hooks/add_filter.mdx: scenario hooks/does_not_exist does not exist');
    expect(p.exitCode).toBe(1);
  });

  test('an unknown stage is refused with the list of stages', () => {
    const p = Bun.spawnSync(['bun', join(repo, 'packages', 'cli', 'src', 'main.ts'), 'nope']);
    expect(p.exitCode).toBe(2);
    expect(p.stderr.toString()).toContain('extract, fork, assign, graph, history, validate, all');
  });
});
