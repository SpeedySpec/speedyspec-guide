import { beforeAll, describe, expect, test } from 'bun:test';
import { join } from 'node:path';
import { type GuideData, readGuideData } from '../src/model/data.ts';
import { architectureDiagram, escapeLabel, seamDiagram } from '../src/model/mermaid.ts';
import { renderMermaid } from '../src/model/render-mermaid.ts';
import { seamView } from '../src/model/views.ts';

const fixtures = join(import.meta.dir, 'fixtures');
let d: GuideData;
let diagram: string;
beforeAll(async () => {
  d = await readGuideData({ GUIDE_DATA_DIR: join(fixtures, 'generated'), GUIDE_SEAMS_DIR: join(fixtures, 'seams'), GUIDE_CONTENT_DIR: join(fixtures, 'content') });
  diagram = seamDiagram(seamView('hooks', 'wordpress', d), d)!;
});

const nodeLine = (label: string) => diagram.split('\n').find((l) => l.includes(`"${label}`));

describe('escapeLabel', () => {
  test('quotes the label and escapes what Mermaid would read as syntax', () => {
    const label = escapeLabel('pre_option_{$option} "x" <a>');
    expect(label.startsWith('"') && label.endsWith('"')).toBe(true);
    expect(label.slice(1, -1)).not.toMatch(/[{}"<>]/);
  });
});

describe('seamDiagram', () => {
  test('is a left-to-right flowchart with one node per function, class and global', () => {
    expect(diagram.startsWith('flowchart LR')).toBe(true);
    for (const name of ['add_filter', 'apply_filters', 'WP_Hook', 'wp_filter']) expect(nodeLine(name)).toBeDefined();
    expect(nodeLine('the_content')).toBeUndefined();
  });

  test('a global is drawn as a stadium', () => {
    expect(nodeLine('wp_filter')).toMatch(/\(\["wp_filter"\]\)/);
  });

  test('another seam is one node, with a counted calls edge', () => {
    expect(nodeLine('Options')).toBeDefined();
    expect(diagram).toMatch(/-->\|"calls 1"\|/);
  });

  test('a member in a cycle is red and labelled circular, even when the cycle passes through another seam', () => {
    expect(diagram).toContain('classDef cycle fill:#fde8e8,stroke:#9b1c1c,color:#7f1d1d');
    expect(nodeLine('add_filter · circular')).toMatch(/:::cycle/);
    expect(nodeLine('apply_filters')).not.toMatch(/:::cycle/);
  });

  test('each edge of the cycle path gets a red link style', () => {
    expect(diagram.match(/^\s*linkStyle \d+ stroke:#9b1c1c,stroke-width:2px$/gm)?.length).toBe(2);
  });

  test('links through hooks are dashed', async () => {
    const withHook = structuredClone(d);
    withHook.graph.edges.push({ from: 'filter:the_content', to: 'function:apply_filters', kind: 'runs' });
    expect(seamDiagram(seamView('hooks', 'wordpress', withHook), withHook)!).toMatch(/-\.->\|"via the_content"\|/);
  });
});

describe('architectureDiagram', () => {
  test("draws the seam's SpeedySpec crates and their dependencies, and no PHP packages", () => {
    const a = architectureDiagram(d.seams.find((s) => s.id === 'hooks')!, d.crates);
    expect(a.startsWith('flowchart TB')).toBe(true);
    for (const n of ['speedyspec-wp-hooks', 'speedyspec-wp-hooks-php']) expect(a).toContain(`"${n}"`);
    expect(a).not.toContain('wp-plugin');
    expect(a).toMatch(/-->/);
  });
});

describe('renderMermaid', () => {
  test('renders light and dark SVG', async () => {
    const svg = (await renderMermaid(diagram))!;
    expect(svg.light.startsWith('<svg')).toBe(true);
    expect(svg.dark.startsWith('<svg')).toBe(true);
    expect(svg.light).not.toBe(svg.dark);
  }, 60_000);
});

describe('diagram limits and cycle arrows', () => {
  test('two hooks between the same pair of members make one dashed link', () => {
    const two = structuredClone(d);
    two.graph.edges.push({ from: 'filter:the_content', to: 'function:apply_filters', kind: 'runs' });
    two.inventory.symbols.push({ id: 'filter:the_title', kind: 'filter', name: 'the_title', file: 'x.php', line: 1 });
    two.graph.edges.push({ from: 'function:add_filter', to: 'filter:the_title', kind: 'fires' }, { from: 'filter:the_title', to: 'function:apply_filters', kind: 'runs' });
    const text = seamDiagram(seamView('hooks', 'wordpress', two), two)!;
    expect(text.match(/-\.->/g)?.length).toBe(1);
    expect(text).toContain('"via 2 hooks"');
  });

  test('a seam too large to draw gives no diagram', () => {
    const big = structuredClone(d);
    for (let i = 0; i < 300; i++) {
      const id = `function:f${i}`;
      big.inventory.symbols.push({ id, kind: 'function', name: `f${i}`, file: 'wp-includes/plugin.php', line: i });
      big.assignment.seamOf[id] = 'hooks';
      big.graph.edges.push({ from: id, to: 'global:wp_filter', kind: 'reads' }, { from: id, to: 'function:add_filter', kind: 'calls' });
    }
    expect(seamDiagram(seamView('hooks', 'wordpress', big), big)).toBeNull();
  });

  test("cycle arrows follow the seam's own cycles, not the group's stored sample path", () => {
    const elsewhere = structuredClone(d);
    elsewhere.cycles.symbol = [{ path: ['function:x', 'function:y', 'function:x'], possible: false }];
    const text = seamDiagram(seamView('hooks', 'wordpress', elsewhere), elsewhere)!;
    expect(text.match(/linkStyle \d+ stroke:#9b1c1c/g)?.length).toBe(2);
  });
});

describe('a seam many seams depend on', () => {
  test('collapses_each_other_seams_links_to_one_per_direction_past_the_link_cap', () => {
    const others = Array.from({ length: 160 }, (_, i) => `s${i}`);
    const crossSeam = others.flatMap((s, i) => [
      { from: `function:x${i}`, to: 'function:add_filter', kind: 'calls', fromSeam: s, toSeam: 'hooks' },
      { from: `function:x${i}`, to: 'function:add_filter', kind: 'calls', fromSeam: s, toSeam: 'hooks' },
      { from: `function:y${i}`, to: 'function:apply_filters', kind: 'calls', fromSeam: s, toSeam: 'hooks' },
    ]) as GuideData['graph']['crossSeam'];
    const c: GuideData = { ...d, graph: { ...d.graph, crossSeam } };
    const code = seamDiagram(seamView('hooks', 'wordpress', c), c);
    expect(code).not.toBeNull();
    // One link from each other seam, to the member it uses most, counting all of its links.
    const fromS0 = code!.split('\n').filter((l) => /^ {2}n\d+ -->\|"calls 3"\| n\d+$/.test(l));
    expect(fromS0.length).toBe(160);
  });
});
