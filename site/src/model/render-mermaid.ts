/**
 * Mermaid to SVG at build time, light and dark, cached by the diagram's text for the build. Each diagram is rendered
 * in its own short-lived process (mermaid-cli.ts) with a time limit: Chromium inside the build process could stall
 * the whole build.
 */
import { existsSync } from 'node:fs';
import { dirname, join } from 'node:path';
import { fileURLToPath } from 'node:url';
import { guideRoot } from './root.ts';

/**
 * Where mermaid-cli.ts is, starting from a file's path: next to it in the sources, else in the guide root's site.
 *
 * @param from
 *     Path of the file asking (this module's path, sources or bundled).
 * @return
 *     Absolute path of mermaid-cli.ts.
 * @throws Error
 *     If the guide root can't be found either.
 */
export function findMermaidCli(from: string): string {
  const beside = join(dirname(from), 'mermaid-cli.ts');
  return existsSync(beside) ? beside : join(guideRoot(from), 'site', 'src', 'model', 'mermaid-cli.ts');
}

const CLI = findMermaidCli(fileURLToPath(import.meta.url));
/** A diagram Mermaid can't lay out in this time is shown as too large to draw, like one over the size caps. */
const LIMIT_MS = 30_000;
const cache = new Map<string, Promise<{ light: string; dark: string } | null>>();

/** At most this many diagram processes (each with its own Chromium) run at once. */
export const MERMAID_CONCURRENCY = 4;

/** Runs jobs with at most `n` in flight; the rest wait their turn, in order. */
export function limiter(n: number): <T>(job: () => Promise<T>) => Promise<T> {
  let running = 0;
  const waiting: (() => void)[] = [];
  return async (job) => {
    if (running >= n) await new Promise<void>((resolve) => waiting.push(resolve));
    running++;
    try {
      return await job();
    } finally {
      running--;
      waiting.shift()?.();
    }
  };
}
const limit = limiter(MERMAID_CONCURRENCY);

/** The diagram as light and dark SVG, or null when Mermaid can't lay it out within the time limit. */
export function renderMermaid(code: string): Promise<{ light: string; dark: string } | null> {
  const key = new Bun.CryptoHasher('sha256').update(code).digest('hex');
  let result = cache.get(key);
  if (!result) {
    result = limit(() => renderWith(['bun', CLI, key.slice(0, 12)], code, LIMIT_MS));
    cache.set(key, result);
  }
  return result;
}

/** Runs one render command; null when it is killed at the time limit, an error when it fails otherwise. */
export async function renderWith(command: string[], code: string, limitMs: number): Promise<{ light: string; dark: string } | null> {
  const proc = Bun.spawn(command, { stdin: new Blob([code]), stdout: 'pipe', stderr: 'pipe', env: { ...process.env } });
  let timedOut = false;
  const timer = setTimeout(() => {
    timedOut = true;
    proc.kill('SIGKILL');
  }, limitMs);
  const [out, err, exit] = await Promise.all([new Response(proc.stdout).text(), new Response(proc.stderr).text(), proc.exited]).finally(() => clearTimeout(timer));
  if (timedOut) return null;
  if (exit !== 0) throw new Error(`rendering a diagram failed (exit ${exit}): ${err.trim()}\n${code}`);
  try {
    return JSON.parse(out) as { light: string; dark: string };
  } catch (e) {
    throw new Error(`rendering a diagram gave unreadable output (${(e as Error).message}, ${out.length} bytes)\n${code}`);
  }
}
