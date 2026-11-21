/** What keeps the site buildable with every WordPress symbol in a seam. */
import { beforeAll, describe, expect, test } from 'bun:test';
import { join } from 'node:path';
import { type GuideData, readGuideData } from '../src/model/data.ts';
import { indexOf } from '../src/model/index-of.ts';
import { limiter, MERMAID_CONCURRENCY } from '../src/model/render-mermaid.ts';
import { dependencies } from '../src/model/sections.ts';
import { speedyspecVerdict } from '../src/model/verdict.ts';
import { railView, seamView } from '../src/model/views.ts';

const fixtures = join(import.meta.dir, 'fixtures');
let d: GuideData;
beforeAll(async () => {
  d = await readGuideData({ GUIDE_DATA_DIR: join(fixtures, 'generated'), GUIDE_SEAMS_DIR: join(fixtures, 'seams'), GUIDE_CONTENT_DIR: join(fixtures, 'content') });
});
const copy = (change: (c: GuideData) => void): GuideData => {
  const c = { ...d, seams: structuredClone(d.seams), graph: structuredClone(d.graph), fork: { ...d.fork } };
  change(c);
  return c;
};

describe('the rail', () => {
  test('rail_lists_only_the_current_role', () => {
    const rail = railView('function:add_filter', 'wordpress', d);
    const register = rail.roles.find((r) => r.role === 'register')!;
    const run = rail.roles.find((r) => r.role === 'run')!;
    expect(register.members?.map((m) => m.id)).toEqual(['function:add_filter']);
    expect(run.members).toBeNull();
    expect(run.href).toBe('/wordpress/hooks/#role-run');
  });
  test("a method's page opens its class's role", () => {
    const rail = railView('method:WP_Hook::add_filter', 'wordpress', d);
    expect(rail.roles.find((r) => r.role === 'classes-and-state')!.members?.map((m) => m.id)).toContain('class:WP_Hook');
  });
});

describe('roles', () => {
  test('members_without_roles_group_by_kind', () => {
    expect(seamView('options', 'wordpress', d).roles.map((r) => r.role)).toEqual(['functions', 'hooks']);
  });
});

describe('the fork', () => {
  test('outside_the_fork_has_no_fork_verdict', () => {
    const c = copy((x) => {
      x.seams.find((s) => s.id === 'options')!.inFork = false;
      x.fork['function:get_option'] = 'removed';
    });
    expect(speedyspecVerdict('function:get_option', c)).toEqual({ verdict: 'unknown', differences: [], source: 'outside-fork' });
    expect(indexOf(c).hasPage('function:get_option', 'speedyspec')).toBe(false);
  });
});

describe('dependencies', () => {
  test('dependencies_group_by_target', () => {
    const c = copy((x) => {
      x.graph.crossSeam = [
        { from: 'function:a', to: 'function:add_filter', kind: 'calls', fromSeam: 'options', toSeam: 'hooks' },
        { from: 'function:b', to: 'function:add_filter', kind: 'calls', fromSeam: 'options', toSeam: 'hooks' },
        { from: 'function:a', to: 'function:add_filter', kind: 'calls', fromSeam: 'options', toSeam: 'hooks' },
      ] as GuideData['graph']['crossSeam'];
    });
    const rows = dependencies('options', c).dependsOn.get('Hooks')!;
    expect(rows).toHaveLength(1);
    expect(rows[0]).toMatchObject({ target: 'function:add_filter', calls: 3, from: ['function:a', 'function:b'] });
  });
});

describe('diagrams', () => {
  test('no_more_than_four_diagrams_render_at_once', async () => {
    expect(MERMAID_CONCURRENCY).toBe(4);
    const limit = limiter(MERMAID_CONCURRENCY);
    let running = 0;
    let most = 0;
    await Promise.all(
      Array.from({ length: 10 }, () =>
        limit(async () => {
          running++;
          most = Math.max(most, running);
          await Bun.sleep(5);
          running--;
        }),
      ),
    );
    expect(most).toBe(4);
  });
});

describe('paths', () => {
  test('two_ids_differing_only_in_case_get_distinct_paths', async () => {
    const { wordpressPaths } = await import('../src/model/sections.ts');
    const c: GuideData = {
      ...d,
      inventory: { ...d.inventory, symbols: [...d.inventory.symbols, { id: 'constant:OBJECT', kind: 'constant', name: 'OBJECT', file: 'wp-includes/option.php', line: 1 }, { id: 'constant:object', kind: 'constant', name: 'object', file: 'wp-includes/option.php', line: 2 }] },
      assignment: { ...d.assignment, seamOf: { ...d.assignment.seamOf, 'constant:OBJECT': 'options', 'constant:object': 'options' } },
    };
    const slugs = wordpressPaths(c).filter((p) => p.id.startsWith('constant:')).map((p) => p.slug).sort();
    expect(slugs).toEqual(['constant/OBJECT', 'constant/object~2']);
  });
});

describe('a diagram too slow to draw', () => {
  test('a_render_past_the_time_limit_gives_no_diagram', async () => {
    const { renderWith } = await import('../src/model/render-mermaid.ts');
    expect(await renderWith(['bun', '-e', 'await Bun.sleep(5000)'], 'flowchart LR', 200)).toBeNull();
  });
  test('a_render_that_fails_still_fails_the_build', async () => {
    const { renderWith } = await import('../src/model/render-mermaid.ts');
    await expect(renderWith(['sh', '-c', 'echo bad diagram >&2; exit 3'], 'flowchart LR', 5000)).rejects.toThrow(/rendering a diagram failed \(exit 3\)/);
  });
});

describe('long dependency lists', () => {
  test('top_rows_are_the_most_called_then_by_name', async () => {
    const { topRows } = await import('../src/model/sections.ts');
    const row = (target: string, calls: number) => ({ target, calls, from: [], kinds: ['calls'], state: '', circular: false });
    const rows = [row('function:b', 1), row('function:a', 1), row('function:c', 9), row('function:d', 3)];
    expect(topRows(rows, 3).map((r) => r.target)).toEqual(['function:c', 'function:d', 'function:a']);
  });
});

describe('a seam outside the fork', () => {
  test('its_speedyspec_page_has_no_compatibility_rows', async () => {
    const { compatGroups } = await import('../src/model/sections.ts');
    expect(compatGroups('options', d)).not.toBeNull();
    const c = copy((x) => {
      x.seams.find((s) => s.id === 'options')!.inFork = false;
    });
    expect(compatGroups('options', c)).toBeNull();
  });
});
