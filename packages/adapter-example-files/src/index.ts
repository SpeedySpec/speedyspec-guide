import type { ExampleProblem, ExampleSource } from '@speedyspec-guide/contracts';
import { type Example, type ExampleOutcome, SIDES, type Seam, type Side } from '@speedyspec-guide/domain';
import { existsSync } from 'node:fs';
import { join, sep } from 'node:path';

/** Examples in `<seams>/<seam>/examples/<symbol>/<name>.php`, each with `<name>.expect.json` beside it. */
export class ExampleFiles implements ExampleSource {
  constructor(private readonly seamsDir: string, private readonly seams: Seam[]) {}

  async all(): Promise<{ examples: Example[]; problems: ExampleProblem[] }> {
    const examples: Example[] = [];
    const problems: ExampleProblem[] = [];
    const files = new Set<string>();
    for (const seam of this.seams) {
      const dir = join(this.seamsDir, seam.id, 'examples');
      if (!existsSync(dir)) continue;
      for await (const f of new Bun.Glob('*/*.{php,json}').scan({ cwd: dir })) files.add(join(seam.id, 'examples', f.split(sep).join('/')));
    }
    for (const rel of [...files].sort()) {
      const [seamId, , symbol, file] = rel.split('/') as [string, string, string, string];
      const seam = this.seams.find((s) => s.id === seamId)!;
      const where = join(this.seamsDir, rel);
      if (file.endsWith('.expect.json')) {
        const name = file.slice(0, -'.expect.json'.length);
        if (!files.has(`${seamId}/examples/${symbol}/${name}.php`)) problems.push({ where, message: `has no ${name}.php` });
        continue;
      }
      if (!file.endsWith('.php')) continue;
      const name = file.slice(0, -'.php'.length);
      const expectRel = `${seamId}/examples/${symbol}/${name}.expect.json`;
      if (!files.has(expectRel)) {
        problems.push({ where, message: `has no ${name}.expect.json` });
        continue;
      }
      const expectFile = join(this.seamsDir, expectRel);
      const parsed = read(await Bun.file(expectFile).text(), seam);
      if (typeof parsed === 'string') {
        problems.push({ where: expectFile, message: parsed });
        continue;
      }
      examples.push({ id: `${seamId}/${symbol}/${name}`, seam: seamId, symbol, name, file: where, ...parsed, code: await Bun.file(where).text() });
    }
    return { examples, problems };
  }
}

/** The sides and expected outcome in an `.expect.json`, or what is wrong with it. */
function read(text: string, seam: Seam): { sides: Side[]; multisite: boolean; expect: ExampleOutcome } | string {
  let data: Record<string, unknown>;
  try {
    data = JSON.parse(text);
  } catch (e) {
    return `is not JSON: ${(e as Error).message}`;
  }
  if (!Array.isArray(data.sides) || data.sides.length === 0) return 'needs "sides" (a list of wordpress, runtime)';
  if (typeof data.output !== 'string') return 'needs "output" (a string)';
  for (const field of ['return', 'error'] as const) {
    if (!(field in data) || !(data[field] === null || typeof data[field] === 'string')) return `needs "${field}" (a string, or null)`;
  }
  for (const side of data.sides) {
    if (!SIDES.includes(side as Side)) return `side "${String(side)}" is not wordpress or runtime`;
  }
  if (data.multisite !== undefined && typeof data.multisite !== 'boolean') return '"multisite" must be true or false';
  if (data.multisite === true && (data.sides.length !== 1 || data.sides[0] !== 'wordpress')) return '"multisite" runs on wordpress only: its sides must be ["wordpress"]';
  if (data.sides.includes('runtime') && !seam.ported) return `runs on runtime, but the ${seam.id} seam is not ported`;
  return {
    sides: data.sides as Side[],
    multisite: data.multisite === true,
    expect: { output: data.output, return: data.return as string | null, error: data.error as string | null },
  };
}
