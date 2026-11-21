/**
 * Renders one Mermaid diagram, read from stdin, to light and dark SVG, printed as JSON. Run by render-mermaid.ts in
 * a process of its own, so Chromium never shares a process with the site build.
 */
import { createMermaidRenderer } from 'mermaid-isomorphic';

const code = await new Response(Bun.stdin.stream()).text();
const id = process.argv[2] ?? 'm';
const renderer = createMermaidRenderer();
const one = async (theme: 'default' | 'dark') => {
  const [r] = await renderer([code], { prefix: `m${id}-${theme}`, mermaidConfig: { theme, securityLevel: 'strict' } });
  if (!r || r.status === 'rejected') throw new Error(`Mermaid could not render a diagram: ${r ? String(r.reason) : 'no result'}`);
  return r.value.svg;
};
const light = await one('default');
const dark = await one('dark');
// Wait for the whole pair to be written before exiting: a large SVG is more than one pipe buffer. Chromium leaves
// stdout non-blocking, so the write must wait out a full pipe: Bun.write stalls for good at the first full buffer and
// fs.writeSync stops short, while process.stdout waits for the reader to drain it.
const json = JSON.stringify({ light, dark });
await new Promise<void>((resolve, reject) => process.stdout.write(json, (e) => (e ? reject(e) : resolve())));
process.exit(0);
