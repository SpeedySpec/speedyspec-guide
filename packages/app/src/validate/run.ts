import type { Failure, Rule, ValidationContext } from './rule.ts';
import { CitationExists, CitesItsScenario, DocumentedSeamCovered, SeamSymbolsExist, SeamFilesExist, RuntimeMembersListed, DependencyStateRecorded, ExampleHasRun, PortedSeamCovered, CitedLinesUnchanged, EverySymbolInOneSeam, PortedSeamVerified, VersionHasTag, WordPressPagesCiteWordPress } from './rules.ts';

export const ALL_RULES: Rule[] = [EverySymbolInOneSeam, CitationExists, CitedLinesUnchanged, PortedSeamVerified, WordPressPagesCiteWordPress, VersionHasTag, ExampleHasRun, PortedSeamCovered, DocumentedSeamCovered, CitesItsScenario, SeamSymbolsExist, SeamFilesExist, RuntimeMembersListed, DependencyStateRecorded];

/** Runs every rule and returns all failures together, so one run shows everything to fix. */
export async function runRules(rules: Rule[], ctx: ValidationContext): Promise<Failure[]> {
  return (await Promise.all(rules.map((r) => r.check(ctx)))).flat();
}
