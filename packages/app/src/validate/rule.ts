import type { EvidenceSource } from '@speedyspec-guide/contracts';
import type { Assignment, ContentPage, Inventory, PageCitation, PageVersion, Seam, Side } from '@speedyspec-guide/domain';
import type { ExamplesFile } from '../examples.ts';
import type { EvidenceIndex } from '../evidence-index.ts';
import type { HistoryFile } from '../history.ts';

export interface Failure {
  rule: string;
  where: string;
  message: string;
}

export interface ValidationContext {
  inventory: Inventory;
  assignment: Assignment;
  seams: Seam[];
  pages: ContentPage[];
  citations: PageCitation[];
  evidence: EvidenceSource;
  history: HistoryFile;
  versionsOnPages: PageVersion[];
  config: { requireAllAssigned: boolean; requirePortedCoverage?: boolean };
  /** `generated/examples.json`, or null when the runner stages did not run. */
  examples: ExamplesFile | null;
  /** Every example file on disk and the sides it declares: what must have run. */
  declaredExamples: { id: string; sides: Side[] }[];
  /** The runtime's released versions (`speedyspec-php-runtime-v*` tags, without the prefix). */
  runtimeTags: string[];
  /** Per ported seam (the compat area of the same name), which scenarios and breaks exercise which symbol. */
  evidenceIndex: Record<string, EvidenceIndex>;
  /** Every id the runtime declares (Reflection), or null when the runner has not run. */
  runtimeIds: string[] | null;
  /** Cross-seam edges (generated/graph.json). */
  crossSeam: { from: string; to: string; kind: string; fromSeam: string; toSeam: string }[];
}

/** One validation rule. Specification. */
export interface Rule {
  id: string;
  check(ctx: ValidationContext): Promise<Failure[]>;
}
