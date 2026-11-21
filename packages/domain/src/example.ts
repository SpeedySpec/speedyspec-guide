/** Where an example runs: WordPress's own code, or the SpeedySpec runtime's native port. */
export type Side = 'wordpress' | 'runtime';

export const SIDES: readonly Side[] = ['wordpress', 'runtime'];

/** What an example printed, returned (PHP's `var_export`, or null when it didn't return) and threw. */
export interface ExampleOutcome {
  output: string;
  return: string | null;
  error: string | null;
}

/** An example file and what it must do. `id` is `<seam>/<symbol folder>/<name>`. */
export interface Example {
  id: string;
  seam: string;
  symbol: string;
  name: string;
  file: string;
  sides: Side[];
  expect: ExampleOutcome;
}

export interface ExampleRun extends ExampleOutcome {
  id: string;
  side: Side;
}

export interface ExampleResult {
  id: string;
  side: Side;
  passed: boolean;
  actual: ExampleOutcome;
  expected: ExampleOutcome;
}

/** Compares a run with what was expected. An expected error ending in `*` matches any error starting with the rest. */
export function compareExample(expected: ExampleOutcome, run: ExampleRun): ExampleResult {
  const actual: ExampleOutcome = { output: run.output, return: run.return, error: run.error };
  const error =
    expected.error !== null && expected.error.endsWith('*')
      ? actual.error !== null && actual.error.startsWith(expected.error.slice(0, -1))
      : expected.error === actual.error;
  return { id: run.id, side: run.side, passed: error && expected.output === actual.output && expected.return === actual.return, actual, expected };
}
