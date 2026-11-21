import type { ExampleRunner } from '@speedyspec-guide/contracts';
import type { ExampleRun, GuideSymbol, Side } from '@speedyspec-guide/domain';
import { mkdtempSync, rmSync, writeFileSync } from 'node:fs';
import { tmpdir } from 'node:os';
import { join } from 'node:path';

/** ExampleRunner over the `speedyspec-guide-examples` binary (runner/). */
export class RunnerCrate implements ExampleRunner {
  constructor(private readonly binary: string) {}

  async run(side: Side, examples: { id: string; file: string; load: string[] }[], wordpressDir: string): Promise<ExampleRun[]> {
    const dir = mkdtempSync(join(tmpdir(), 'guide-manifest-'));
    try {
      const manifest = join(dir, 'manifest.json');
      writeFileSync(manifest, JSON.stringify({ wordpressDir, examples }));
      return (await this.exec(['run', '--side', side, '--manifest', manifest])) as ExampleRun[];
    } finally {
      rmSync(dir, { recursive: true, force: true });
    }
  }

  async reflect(mode: 'baseline' | 'runtime'): Promise<GuideSymbol[]> {
    return (await this.exec(['reflect', '--mode', mode])) as GuideSymbol[];
  }

  private async exec(args: string[]): Promise<unknown> {
    const proc = Bun.spawn([this.binary, ...args], { stdout: 'pipe', stderr: 'pipe', env: { ...process.env } });
    const [stdout, stderr, code] = await Promise.all([new Response(proc.stdout).text(), new Response(proc.stderr).text(), proc.exited]);
    if (code !== 0) throw new Error(`${this.binary} ${args[0]} failed (exit ${code}): ${stderr.trim()}`);
    return JSON.parse(stdout);
  }
}
