/**
 * Mermaid to SVG at build time, light and dark, cached by the diagram's text for the build. Each diagram is rendered
 * in its own short-lived process (mermaid-cli.ts) with a time limit: Chromium inside the build process could stall
 * the whole build.
 */
import { existsSync } from 'node:fs';
import { join } from 'node:path';
import { fileURLToPath } from 'node:url';

// Next to this file in the sources; in a build this file is bundled into dist/, so fall back to the sources.
const beside = fileURLToPath(new URL('./mermaid-cli.ts', import.meta.url));
const CLI = existsSync(beside) ? beside : join(fileURLToPath(new URL('../../../', import.meta.url)), 'site', 'src', 'model', 'mermaid-cli.ts');
const LIMIT_MS = 120_000;
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
  const proc = Bun.spawn(['bun', CLI, id], { stdin: new Blob([code]), stdout: 'pipe', stderr: 'pipe', env: { ...process.env } });
  const timer = setTimeout(() => proc.kill('SIGKILL'), LIMIT_MS);
  const [out, err, exit] = await Promise.all([new Response(proc.stdout).text(), new Response(proc.stderr).text(), proc.exited]).finally(() => clearTimeout(timer));
  if (exit !== 0) throw new Error(`rendering a diagram failed (exit ${exit}): ${err.trim() || 'killed after the time limit'}\n${code}`);
  try {
    return JSON.parse(out) as { light: string; dark: string };
  } catch (e) {
    throw new Error(`rendering a diagram gave unreadable output (${(e as Error).message}, ${out.length} bytes)\n${code}`);
  }
}
