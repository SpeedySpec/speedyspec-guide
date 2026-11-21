/** Mermaid to SVG at build time, light and dark, cached by the diagram's text for the build. */
import { createMermaidRenderer, type MermaidRenderer } from 'mermaid-isomorphic';

let renderer: MermaidRenderer | null = null;
const cache = new Map<string, Promise<{ light: string; dark: string }>>();

export function renderMermaid(code: string): Promise<{ light: string; dark: string }> {
  const key = new Bun.CryptoHasher('sha256').update(code).digest('hex');
  let result = cache.get(key);
  if (!result) {
    result = render(code, key.slice(0, 12));
    cache.set(key, result);
  }
  return result;
}

async function render(code: string, id: string): Promise<{ light: string; dark: string }> {
  renderer ??= createMermaidRenderer();
  const one = async (theme: 'default' | 'dark') => {
    const [r] = await renderer!([code], { prefix: `m${id}-${theme}`, mermaidConfig: { theme, securityLevel: 'strict' } });
    if (!r || r.status === 'rejected') throw new Error(`Mermaid could not render a diagram: ${r ? String(r.reason) : 'no result'}\n${code}`);
    return r.value.svg;
  };
  return { light: await one('default'), dark: await one('dark') };
}
