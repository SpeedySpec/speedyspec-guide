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
  diagram = seamDiagram(seamView('hooks', 'wordpress', d), d);
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
    expect(seamDiagram(seamView('hooks', 'wordpress', withHook), withHook)).toMatch(/-\.->\|"via the_content"\|/);
  });
});

describe('architectureDiagram', () => {
  test("draws the seam's packages and crates and the crates' dependencies", () => {
    const a = architectureDiagram(d.seams.find((s) => s.id === 'hooks')!, d.crates);
    expect(a.startsWith('flowchart TB')).toBe(true);
    for (const n of ['wp-plugin', 'speedyspec-wp-hooks', 'speedyspec-wp-hooks-php']) expect(a).toContain(`"${n}"`);
    expect(a).toMatch(/-->/);
  });
});

describe('renderMermaid', () => {
  test('renders light and dark SVG', async () => {
    const svg = await renderMermaid(diagram);
    expect(svg.light.startsWith('<svg')).toBe(true);
    expect(svg.dark.startsWith('<svg')).toBe(true);
    expect(svg.light).not.toBe(svg.dark);
  }, 60_000);
});
