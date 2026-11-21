import type { ExampleProblem, ExampleRunner, ExampleSource } from '@speedyspec-guide/contracts';
import { compareExample, type ExampleResult, type GuideSymbol, SIDES, type Seam, type Side } from '@speedyspec-guide/domain';

export interface ExamplesFile {
  results: ExampleResult[];
  problems: ExampleProblem[];
  /** Every example and the sides it declares, so a side with no result shows. */
  declared: { id: string; sides: Side[] }[];
}

/** Runs every example on each side it declares (one runner call per side) and compares it with what it expects. */
export async function runExamples(source: ExampleSource, runner: ExampleRunner, seams: Seam[], wordpressDir: string): Promise<ExamplesFile> {
  const { examples, problems } = await source.all();
  const results: ExampleResult[] = [];
  for (const side of SIDES) {
    const here = examples.filter((e) => e.sides.includes(side));
    if (here.length === 0) continue;
    const load = (seamId: string) => (side === 'wordpress' ? (seams.find((s) => s.id === seamId)?.wordpress ?? []) : []);
    const runs = await runner.run(side, here.map((e) => ({ id: e.id, file: e.file, load: load(e.seam) })), wordpressDir);
    for (const run of runs) {
      const example = here.find((e) => e.id === run.id);
      if (example) results.push(compareExample(example.expect, run));
    }
  }
  return { results, problems, declared: examples.map((e) => ({ id: e.id, sides: e.sides })) };
}

/** The runtime's own PHP API: what PHP declares with the runtime's native areas, and not without them. */
export async function runtimeApi(runner: ExampleRunner): Promise<GuideSymbol[]> {
  const baseline = new Set((await runner.reflect('baseline')).map((s) => s.id));
  return (await runner.reflect('runtime')).filter((s) => !baseline.has(s.id));
}
