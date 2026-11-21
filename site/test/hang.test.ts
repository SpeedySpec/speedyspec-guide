import { describe, expect, test } from 'bun:test';
import { mkdtempSync, writeFileSync } from 'node:fs';
import { tmpdir } from 'node:os';
import { join } from 'node:path';

const renderer = join(import.meta.dir, '..', 'src', 'model', 'render-mermaid.ts');

describe('rendering a diagram', () => {
  test('leaves nothing running that would keep a failed build from exiting', () => {
    const dir = mkdtempSync(join(tmpdir(), 'guide-hang-'));
    const script = join(dir, 'fail-after-diagram.ts');
    writeFileSync(script, `import { renderMermaid } from ${JSON.stringify(renderer)};\nawait renderMermaid('flowchart LR\\n  a --> b');\nthrow new Error('a page failed');\n`);
    const started = Date.now();
    const p = Bun.spawnSync(['bun', script], { timeout: 60_000 });
    expect(p.exitCode).not.toBe(0);
    expect(p.signalCode ?? null).toBeNull();
    expect(Date.now() - started).toBeLessThan(30_000);
  }, 90_000);
});
