import type { EvidenceSource } from '@speedyspec-guide/contracts';
import { existsSync } from 'node:fs';
import { join, relative, resolve } from 'node:path';

interface Catalogue { scenarios: { name: string; steps: { call: string; args?: unknown[] }[] }[] }
interface Breaks { breaks: { scenario: string; step?: number; why: string }[] }

/** Evidence from a speedyspec-server checkout (compat files, tests) and the two code bases (source lines). */
export class CompatFilesEvidence implements EvidenceSource {
  private readonly json = new Map<string, unknown>();

  constructor(private readonly serverDir: string, private readonly wordpressDir: string, private readonly forkDir: string) {}

  async scenarioExists(area: string, name: string): Promise<boolean> {
    const c = await this.read<Catalogue>(join('compat', area, 'scenarios.json'));
    return c?.scenarios.some((s) => s.name === name) ?? false;
  }

  /** A break without a step covers every step of its scenario. */
  async breakExists(area: string, scenario: string, step?: number): Promise<boolean> {
    const b = await this.read<Breaks>(join('compat', area, 'breaks.json'));
    return b?.breaks.some((x) => x.scenario === scenario && (x.step === undefined || x.step === step)) ?? false;
  }

  /** `<crate>::<tests file stem>::<fn>`, found as `fn <fn>` in `crates/<crate>/tests/<stem>.rs`. */
  async testExists(path: string): Promise<boolean> {
    const [crate, stem, fn, ...rest] = path.split('::');
    if (!crate || !stem || !fn || rest.length > 0) return false;
    const file = join(this.serverDir, 'crates', crate, 'tests', `${stem}.rs`);
    if (!existsSync(file)) return false;
    return new RegExp(`\\bfn\\s+${fn.replace(/\W/g, '')}\\s*\\(`).test(await Bun.file(file).text());
  }

  async sourceLines(base: 'wp' | 'ss', file: string, from: number, to: number): Promise<string | null> {
    const root = resolve(base === 'wp' ? this.wordpressDir : this.forkDir);
    const full = resolve(root, file);
    if (relative(root, full).startsWith('..') || !existsSync(full)) return null;
    const lines = (await Bun.file(full).text()).split('\n');
    if (from < 1 || to > lines.length || to < from) return null;
    return lines.slice(from - 1, to).join('\n');
  }

  async catalogue(area: string): Promise<{ scenarios: Catalogue['scenarios']; breaks: Breaks['breaks'] } | null> {
    const c = await this.read<Catalogue>(join('compat', area, 'scenarios.json'));
    if (!c) return null;
    const b = await this.read<Breaks>(join('compat', area, 'breaks.json'));
    return { scenarios: c.scenarios, breaks: b?.breaks ?? [] };
  }

  private async read<T>(path: string): Promise<T | null> {
    if (!this.json.has(path)) {
      const file = join(this.serverDir, path);
      this.json.set(path, existsSync(file) ? await Bun.file(file).json() : null);
    }
    return this.json.get(path) as T | null;
  }
}
