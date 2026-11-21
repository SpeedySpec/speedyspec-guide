import type { SymbolSource } from '@speedyspec-guide/contracts';
import type { Inventory } from '@speedyspec-guide/domain';
import { join } from 'node:path';

const EXTRACTOR = join(import.meta.dir, '..', 'extractor', 'extract.php');

/** SymbolSource over the PHP extractor (`extractor/extract.php`, nikic/php-parser). */
export class PhpParserSource implements SymbolSource {
  constructor(private readonly php: string = 'php', private readonly stubs: string[] = []) {}

  async extract(root: string, base: 'wp' | 'ss', version: string): Promise<Inventory> {
    const args = this.stubs.length > 0 ? [`--stubs=${this.stubs.join(',')}`] : [];
    const proc = Bun.spawn([this.php, '-d', 'memory_limit=2G', EXTRACTOR, root, base, version, ...args], { stdout: 'pipe', stderr: 'pipe' });
    const [stdout, stderr, code] = await Promise.all([
      new Response(proc.stdout).text(),
      new Response(proc.stderr).text(),
      proc.exited,
    ]);
    if (code !== 0) throw new Error(`extracting ${root} failed (exit ${code}): ${stderr.trim()}`);
    if (stderr.trim() !== '') process.stderr.write(stderr);
    return JSON.parse(stdout) as Inventory;
  }
}
