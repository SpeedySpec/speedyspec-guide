import type { EvidenceSource } from '@speedyspec-guide/contracts';
import { existsSync } from 'node:fs';
import { join, relative, resolve } from 'node:path';

interface Catalogue { scenarios: { name: string; steps: { call: string; args?: unknown[] }[] }[] }
/** A recorded release file: each scenario's steps, with the callbacks each step invoked. */
interface Recorded { results: Record<string, { invocations?: { fixture?: unknown }[] }[]> }
interface Breaks { breaks: { scenario: string; step?: number; why: string }[] }

/** Evidence from a speedyspec-server checkout (compat files, tests) and the two code bases (source lines). */
export class CompatFilesEvidence implements EvidenceSource {
  private readonly json = new Map<string, unknown>();

  constructor(private readonly serverDir: string, private readonly wordpressDir: string) {}

  async scenarioExists(area: string, name: string): Promise<boolean> {
    const c = await this.read<Catalogue>(join('compat', area, 'scenarios.json'));
    return c?.scenarios.some((s) => s.name === name) ?? false;
  }

  /** A break without a step covers every step of its scenario; a citation without a step names any of its breaks. */
  async breakExists(area: string, scenario: string, step?: number): Promise<boolean> {
    const b = await this.read<Breaks>(join('compat', area, 'breaks.json'));
    return b?.breaks.some((x) => x.scenario === scenario && (x.step === undefined || step === undefined || x.step === step)) ?? false;
  }

  /**
   * `<crate>::<tests file stem>::<name>`, found in `crates/<crate>/tests/<stem>.rs` as `fn <name>(` or, for a harness-style
   * test, as a check named `"<name>"`.
   */
  async testExists(path: string): Promise<boolean> {
    const [crate, stem, fn, ...rest] = path.split('::');
    if (!crate || !stem || !fn || rest.length > 0) return false;
    const file = join(this.serverDir, 'crates', crate, 'tests', `${stem}.rs`);
    if (!existsSync(file)) return false;
    const name = fn.replace(/\W/g, '');
    const text = await Bun.file(file).text();
    return new RegExp(`\\bfn\\s+${name}\\s*\\(`).test(text) || new RegExp(`\\bcheck\\(\\s*"${name}"`).test(text);
  }

  async sourceLines(base: 'wp' | 'ss', file: string, from: number, to: number): Promise<string | null> {
    // ss: cites speedyspec-server only (crates/, compat/); WordPress's lines are the pinned trunk export.
    if (base === 'ss' && !(file.startsWith('crates/') || file.startsWith('compat/'))) return null;
    const root = resolve(base === 'wp' ? this.wordpressDir : this.serverDir);
    const full = resolve(root, file);
    if (relative(root, full).startsWith('..') || !existsSync(full)) return null;
    const lines = (await Bun.file(full).text()).split('\n');
    if (from < 1 || to > lines.length || to < from) return null;
    return lines.slice(from - 1, to).join('\n');
  }

  /**
   * `compat/<area>/source.json`'s `wordpress` override, else the repository's pin, `compat/wordpress.json`'s
   * `wordpress`; null when the area has no compat folder or neither names a release.
   */
  async compatVersion(area: string): Promise<string | null> {
    if (!existsSync(join(this.serverDir, 'compat', area))) return null;
    const override = (await this.read<{ wordpress?: unknown }>(join('compat', area, 'source.json')))?.wordpress;
    if (typeof override === 'string') return override;
    const pin = (await this.read<{ wordpress?: unknown }>(join('compat', 'wordpress.json')))?.wordpress;
    return typeof pin === 'string' ? pin : null;
  }

  async catalogue(area: string): Promise<{ scenarios: Catalogue['scenarios']; breaks: Breaks['breaks']; fired?: Record<string, string[]> } | null> {
    const c = await this.read<Catalogue>(join('compat', area, 'scenarios.json'));
    if (!c) return null;
    const b = await this.read<Breaks>(join('compat', area, 'breaks.json'));
    const fired = await this.fired(area);
    return { scenarios: c.scenarios, breaks: b?.breaks ?? [], ...(fired === null ? {} : { fired }) };
  }

  /** The recorders that fired in each scenario, across every recorded release file of an area; null when none. */
  private async fired(area: string): Promise<Record<string, string[]> | null> {
    const dir = join(this.serverDir, 'compat', area);
    if (!existsSync(dir)) return null;
    const files = [...new Bun.Glob('wordpress-*.json').scanSync({ cwd: dir })].sort();
    if (files.length === 0) return null;
    const out: Record<string, string[]> = {};
    for (const file of files) {
      const recorded = await this.read<Recorded>(join('compat', area, file));
      for (const [scenario, steps] of Object.entries(recorded?.results ?? {})) {
        const labels = (out[scenario] ??= []);
        for (const step of steps) for (const i of step.invocations ?? []) if (typeof i.fixture === 'string' && !labels.includes(i.fixture)) labels.push(i.fixture);
      }
    }
    return out;
  }

  private async read<T>(path: string): Promise<T | null> {
    if (!this.json.has(path)) {
      const file = join(this.serverDir, path);
      this.json.set(path, existsSync(file) ? await Bun.file(file).json() : null);
    }
    return this.json.get(path) as T | null;
  }
}
