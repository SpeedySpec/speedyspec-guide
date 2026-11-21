import type { SeamRepository } from '@speedyspec-guide/contracts';
import { type DependencyState, type Edge, type EdgeKind, parseCitation, type Seam } from '@speedyspec-guide/domain';
import { readdirSync, existsSync } from 'node:fs';
import { join } from 'node:path';
import { parse } from 'yaml';

/** Fixed routes under /speedyspec/, so never seam ids. */
const RESERVED = ['porting', 'architecture', 'runtime'];
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
    function dependencies(): Record<string, DependencyState> {
      const v = (data!.dependencies ?? {}) as Record<string, unknown>;
      for (const [target, state] of Object.entries(v)) {
        if (!STATES.includes(String(state))) throw new Error(`${where}: dependency ${target} must be php, port or rust`);
      }
      return v as Record<string, DependencyState>;
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
      packages: list('packages'),
      crates: list('crates'),
      forkPackages: list('forkPackages'),
      inFork: data.inFork !== false,
      dependencies: dependencies(),
      edges,
    };
  }
}
