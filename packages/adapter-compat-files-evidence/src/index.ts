import type { EvidenceSource } from '@speedyspec-guide/contracts';
import { existsSync, readdirSync } from 'node:fs';
import { join, relative, resolve } from 'node:path';

interface Catalogue { scenarios: { name: string; steps: { call: string; args?: unknown[] }[] }[] }
/** A recorded release file: each scenario's steps, with the callbacks each step invoked. */
interface Recorded { results: Record<string, { invocations?: { fixture?: unknown }[] }[]> }
interface Breaks { breaks: { scenario: string; step?: number; why: string }[] }

/**
 * Evidence from a speedyspec-server checkout (compat files, tests) and the two code bases (source lines).
 *
 * speedyspec-server's shared crates and compat areas moved to speedyspec-platform, which it now takes from crates.io.
 * `ss:` names one code base, SpeedySpec's: a path is looked up in the server first, then in each further checkout
 * (the platform), so a citation stays valid when its crate moves. A path is in one repository only.
 */
export class CompatFilesEvidence implements EvidenceSource {
  private readonly json = new Map<string, unknown>();
  private readonly speedyspecDirs: string[];

  constructor(serverDir: string | string[], private readonly wordpressDir: string) {
    this.speedyspecDirs = Array.isArray(serverDir) ? serverDir : [serverDir];
  }

  /** The first SpeedySpec checkout that has `path`, or null. */
  private locate(path: string): string | null {
    for (const dir of this.speedyspecDirs) if (existsSync(join(dir, path))) return dir;
    return null;
  }

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
    const rel = join('crates', crate, 'tests', `${stem}.rs`);
    const dir = this.locate(rel);
    if (dir === null) return false;
    const file = join(dir, rel);
    const name = fn.replace(/\W/g, '');
    const text = await Bun.file(file).text();
    return new RegExp(`\\bfn\\s+${name}\\s*\\(`).test(text) || new RegExp(`\\bcheck\\(\\s*"${name}"`).test(text);
  }

  async sourceLines(base: 'wp' | 'ss', file: string, from: number, to: number): Promise<string | null> {
    // ss: cites speedyspec-server only (crates/, compat/); WordPress's lines are the pinned trunk export.
    if (base === 'ss' && !(file.startsWith('crates/') || file.startsWith('compat/'))) return null;
    const root = resolve(base === 'wp' ? this.wordpressDir : (this.locate(file) ?? this.speedyspecDirs[0]!));
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
    if (this.locate(join('compat', area)) === null) return null;
    const override = (await this.read<{ wordpress?: unknown }>(join('compat', area, 'source.json')))?.wordpress;
    if (typeof override === 'string') return override;
    const pin = (await this.read<{ wordpress?: unknown }>(join('compat', 'wordpress.json')))?.wordpress;
    return typeof pin === 'string' ? pin : null;
  }

  /** The crates and compat areas only a later checkout (the platform) has. */
  async platformPaths(): Promise<{ crates: string[]; compat: string[] }> {
    const [first, ...rest] = this.speedyspecDirs;
    const only = (dir: string) => {
      const names = new Set<string>();
      for (const root of rest) {
        const from = join(root, dir);
        if (!existsSync(from)) continue;
        for (const entry of readdirSync(from, { withFileTypes: true })) {
          if (entry.isDirectory() && !existsSync(join(first!, dir, entry.name))) names.add(entry.name);
        }
      }
      return [...names].sort();
    };
    return { crates: only('crates'), compat: only('compat') };
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
    const root = this.locate(join('compat', area));
    if (root === null) return null;
    const dir = join(root, 'compat', area);
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
      const dir = this.locate(path);
      this.json.set(path, dir === null ? null : await Bun.file(join(dir, path)).json());
    }
    return this.json.get(path) as T | null;
  }
}
