import type { SeamRepository } from '@speedyspec-guide/contracts';
import { type Citation, type DependencyState, type Edge, type EdgeKind, parseCitation, type Seam } from '@speedyspec-guide/domain';
import { readdirSync, existsSync } from 'node:fs';
import { join } from 'node:path';
import { parse } from 'yaml';

/** Fixed routes under /speedyspec/, so never seam ids. */
const RESERVED = ['porting', 'architecture', 'runtime', 'conversion'];
const STATES = ['php', 'port', 'rust'];

const EDGE_KINDS: EdgeKind[] = ['calls', 'reads', 'writes', 'fires', 'runs', 'matches', 'alias', 'undone-by'];

/** The seam map: one `<id>/seam.yaml` per seam. Repository. */
export class SeamFiles implements SeamRepository {
  constructor(private readonly dir: string) {}

  async all(): Promise<Seam[]> {
    const ids = readdirSync(this.dir, { withFileTypes: true })
      .filter((d) => d.isDirectory() && existsSync(join(this.dir, d.name, 'seam.yaml')))
      .map((d) => d.name)
      .sort();
    const reserved = ids.find((id) => RESERVED.includes(id));
    if (reserved) throw new Error(`seams/${reserved}: ${reserved} is reserved for a route; name the seam otherwise`);
    return Promise.all(ids.map((id) => this.read(id)));
  }

  private async read(id: string): Promise<Seam> {
    const file = join(this.dir, id, 'seam.yaml');
    const where = `${id}/seam.yaml`;
    const data = parse(await Bun.file(file).text()) as Record<string, unknown> | null;
    if (data === null || typeof data !== 'object') throw new Error(`${where}: not a mapping`);
    const text = (field: string): string => {
      const v = data[field];
      if (typeof v !== 'string' || v.trim() === '') throw new Error(`${where}: missing or empty field "${field}"`);
      return v;
    };
    const list = (field: string): string[] => {
      const v = data[field] ?? [];
      if (!Array.isArray(v) || v.some((x) => typeof x !== 'string')) throw new Error(`${where}: "${field}" must be a list of strings`);
      return v as string[];
    };
    for (const gone of ['forkPackages', 'inFork']) {
      if (gone in data) throw new Error(`${where}: ${gone} is no longer supported; list the seam's WordPress files`);
    }
    if ('packages' in data) throw new Error(`${where}: packages is no longer supported; SpeedySpec doesn't ship the PHP packages/ tree`);
    const roles = (data.roles ?? {}) as Record<string, unknown>;
    for (const [role, members] of Object.entries(roles)) {
      if (!Array.isArray(members) || members.some((x) => typeof x !== 'string')) throw new Error(`${where}: role "${role}" must be a list of ids`);
    }
    const edges = ((data.edges ?? []) as Record<string, unknown>[]).map((e, i): Edge => {
      if (typeof e.from !== 'string' || typeof e.to !== 'string' || !EDGE_KINDS.includes(e.kind as EdgeKind)) {
        throw new Error(`${where}: edge ${i} needs from, to and a kind of ${EDGE_KINDS.join(', ')}`);
      }
      const edge: Edge = { from: e.from, to: e.to, kind: e.kind as EdgeKind };
      if (e.at !== undefined) edge.at = parseCitation(Object.fromEntries(Object.entries(e.at as object).map(([k, v]) => [k, String(v)])));
      return edge;
    });
    function dependencies(): Record<string, { state: DependencyState; cite: Citation }> {
      const v = (data!.dependencies ?? {}) as Record<string, unknown>;
      const out: Record<string, { state: DependencyState; cite: Citation }> = {};
      for (const [target, entry] of Object.entries(v)) {
        const e = (entry ?? {}) as { state?: unknown; cite?: unknown };
        if (!STATES.includes(String(e.state))) throw new Error(`${where}: dependency ${target} needs a state of php, port or rust`);
        if (typeof e.cite !== 'object' || e.cite === null) throw new Error(`${where}: dependency ${target} needs a cite (source, test, scenario, break or example)`);
        const cite = parseCitation(Object.fromEntries(Object.entries(e.cite as object).map(([k, x]) => [k, String(x)])));
        out[target] = { state: e.state as DependencyState, cite };
      }
      return out;
    }
    let setup: string | undefined;
    if (data.setup !== undefined) {
      if (typeof data.setup !== 'string' || data.setup.trim() === '') throw new Error(`${where}: "setup" must be a file name`);
      setup = join(this.dir, id, data.setup);
      if (!existsSync(setup)) throw new Error(`${where}: setup file ${data.setup} does not exist`);
    }
    return {
      id,
      name: text('name'),
      job: text('job'),
      ported: data.ported === true,
      files: list('files'),
      symbols: list('symbols'),
      exclude: list('exclude'),
      roles: roles as Record<string, string[]>,
      wordpress: list('wordpress'),
      crates: list('crates'),
      dependencies: dependencies(),
      edges,
      ...(setup === undefined ? {} : { setup }),
    };
  }
}
