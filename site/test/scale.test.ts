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


describe('a runtime method of a WordPress class', () => {
  test('is_a_method_on_its_class_page_not_a_page_of_its_own', () => {
    const id = 'method:WP_Hook::speedyspec_wrap';
    const c: GuideData = { ...d, runtimeSeamOf: { ...d.runtimeSeamOf, [id]: 'hooks' }, runtime: [...d.runtime, { id, kind: 'method', name: 'speedyspec_wrap', file: '', line: 0 }] };
    const ix = indexOf(c);
    expect(ix.hasPage(id, 'speedyspec')).toBe(false);
    expect(ix.methodsOf('class:WP_Hook', 'speedyspec')).toContain(id);
    expect(ix.methodsOf('class:WP_Hook', 'wordpress')).not.toContain(id);
  });
});

describe('a recorded dependency state', () => {
  test('dependency_row_shows_state_and_citation', () => {
    const cite = { kind: 'scenario' as const, area: 'hooks', name: 'add_filter_returns_true' };
    const c = copy((x) => {
      x.seams.find((s) => s.id === 'options')!.dependencies = { 'function:add_filter': { state: 'port', cite } };
      x.graph.crossSeam = [{ from: 'function:get_option', to: 'function:add_filter', kind: 'calls', fromSeam: 'options', toSeam: 'hooks' }] as GuideData['graph']['crossSeam'];
    });
    const row = dependencies('options', c).dependsOn.get('Hooks')![0]!;
    expect(row.state).toBe('behind a port');
    expect(row.cite).toEqual(cite);
  });
});

describe('a seam with only SpeedySpec symbols', () => {
  const withContainer = (): GuideData => {
    const id = 'class:SpeedySpec\\Container\\Container';
    return {
      ...d,
      seams: [...d.seams, { ...d.seams[0]!, id: 'container', name: 'Container', ported: true, files: [], symbols: [id], roles: {}, edges: [], dependencies: {} }],
      runtimeSeamOf: { ...d.runtimeSeamOf, [id]: 'container' },
      runtime: [...d.runtime, { id, kind: 'class', name: 'SpeedySpec\\Container\\Container', file: '', line: 0 }],
    };
  };
  test('speedyspec_only_seam_has_no_wordpress_page', async () => {
    const { speedyspecOnly, wordpressSeams } = await import('../src/model/views.ts');
    const { speedyspecPaths, wordpressPaths } = await import('../src/model/sections.ts');
    const c = withContainer();
    expect(speedyspecOnly('container', c)).toBe(true);
    expect(speedyspecOnly('hooks', c)).toBe(false);
    expect(wordpressSeams(c).map((s) => s.id)).not.toContain('container');
    expect(wordpressPaths(c).some((p) => p.seam === 'container')).toBe(false);
    expect(speedyspecPaths(c).some((p) => p.seam === 'container')).toBe(true);
  });
  test('runtime_page_is_empty_when_every_symbol_is_seamed', async () => {
    const { unplacedRuntime } = await import('../src/model/sections.ts');
    const wordpress = new Set(d.inventory.symbols.map((s) => s.id));
    const all = Object.fromEntries(d.runtime.filter((s) => !wordpress.has(s.id)).map((s) => [s.id, 'hooks']));
    expect(unplacedRuntime({ ...d, runtimeSeamOf: all })).toEqual([]);
    expect(unplacedRuntime({ ...d, runtimeSeamOf: {} }).length).toBeGreaterThan(0);
  });
});

describe("a seam's home page", () => {
  test('seam_href_is_speedyspec_for_a_speedyspec_only_seam', async () => {
    const { seamHref } = await import('../src/model/views.ts');
    const id = 'class:SpeedySpec\\Container\\Container';
    const c: GuideData = { ...d, seams: [...d.seams, { ...d.seams[0]!, id: 'container', name: 'Container', symbols: [id], roles: {}, edges: [], dependencies: {} }], runtimeSeamOf: { ...d.runtimeSeamOf, [id]: 'container' } };
    expect(seamHref('container', c)).toBe('/speedyspec/container/');
    expect(seamHref('hooks', c)).toBe('/wordpress/hooks/');
  });
});
