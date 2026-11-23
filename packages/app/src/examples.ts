import type { ExampleProblem, ExampleRunner, ExampleSource } from '@speedyspec-guide/contracts';
import { compareExample, type Example, type ExampleOutcome, type ExampleResult, type GuideSymbol, SIDES, type Seam, type Side } from '@speedyspec-guide/domain';

export interface ExamplesFile {
  results: ExampleResult[];
  problems: ExampleProblem[];
  /** Every example and the sides it declares, so a side with no result shows. */
  declared: { id: string; sides: Side[] }[];
}

/**
 * Runs every example on each side it declares and compares it with what it expects. Each seam's examples on a side
 * run in a runner call of their own, so the runner's time limit guards one seam, not the whole guide. A
 * seam marked `mysql` needs a MySQL database (`mysqlUrl`, which the runner reads from its environment as
 * `GUIDE_MYSQL_URL`): without one this throws before running anything.
 */
export async function runExamples(source: ExampleSource, runner: ExampleRunner, seams: Seam[], wordpressDir: string, mysqlUrl: string | null): Promise<ExamplesFile> {
  const { examples, problems } = await source.all();
  const seamOf = (id: string) => seams.find((s) => s.id === id);
  if (mysqlUrl === null) {
    const needing = examples.find((e) => e.sides.includes('wordpress') && seamOf(e.seam)?.mysql === true);
    if (needing) throw new Error(`the ${needing.seam} seam's examples need a MySQL database: set GUIDE_MYSQL_URL (see README)`);
  }
  const results: ExampleResult[] = [];
  for (const side of SIDES) {
    const wp = side === 'wordpress';
    for (const here of bySeam(examples.filter((e) => e.sides.includes(side)))) {
      const runs = await runner.run(
        side,
        here.map((e) => ({ id: e.id, file: e.file, load: wp ? (seamOf(e.seam)?.wordpress ?? []) : [], setup: wp ? (seamOf(e.seam)?.setup ?? null) : null, multisite: wp && e.multisite })),
        wordpressDir,
      );
      for (const run of runs) {
        const example = here.find((e) => e.id === run.id);
        if (example) results.push(compareExample(example.expect, run));
      }
    }
  }
  return { results, problems, declared: examples.map((e) => ({ id: e.id, sides: e.sides })) };
}

/** The examples grouped by seam, in the order each seam first appears. */
function bySeam(examples: Example[]): Example[][] {
  const groups = new Map<string, Example[]>();
  for (const e of examples) {
    const group = groups.get(e.seam);
    if (group) group.push(e);
    else groups.set(e.seam, [e]);
  }
  return [...groups.values()];
}

/**
 * The runtime's own PHP API: what PHP declares with the runtime's native areas and not without them, plus what
 * SpeedySpec registers in every PHP it boots (the `SpeedySpec\\` namespace, such as `SpeedySpec\\Hooks\\Hook`).
 */
export async function runtimeApi(runner: ExampleRunner): Promise<GuideSymbol[]> {
  const baseline = new Set((await runner.reflect('baseline')).map((s) => s.id));
  const speedyspec = (id: string) => id.slice(id.indexOf(':') + 1).startsWith('SpeedySpec\\');
  return (await runner.reflect('runtime')).filter((s) => !baseline.has(s.id) || speedyspec(s.id));
}

/**
 * What is wrong with the examples: problems with their files, and each declared side that failed or never ran.
 * `declared` comes from the example files on disk, so an example added since the results were written shows as not run.
 */
export function exampleFailures(file: ExamplesFile | null, declared: { id: string; sides: Side[] }[]): { where: string; message: string }[] {
  if (file === null) {
    if (declared.length === 0) return [];
    const n = declared.length;
    return [{ where: 'generated/examples.json', message: `${n} example${n === 1 ? ' has' : 's have'} not run: bun run runner:build && bun run guide examples` }];
  }
  const out = file.problems.map((p) => ({ where: p.where, message: p.message }));
  for (const { id, sides } of declared) {
    for (const side of sides) {
      const r = file.results.find((x) => x.id === id && x.side === side);
      if (!r) out.push({ where: id, message: `did not run on ${side}` });
      else if (!r.passed) out.push({ where: id, message: `fails on ${side}: ${difference(r.expected, r.actual)}` });
    }
  }
  return out;
}

function difference(expected: ExampleOutcome, actual: ExampleOutcome): string {
  const parts: string[] = [];
  for (const field of ['return', 'error', 'output'] as const) {
    if (expected[field] !== actual[field]) parts.push(`expected ${field} ${String(expected[field])}, got ${String(actual[field])}`);
  }
  return parts.join('; ');
}
