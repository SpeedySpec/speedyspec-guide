import type { EvidenceSource } from '@speedyspec-guide/contracts';
import type { Assignment, ContentPage, Inventory, PageCitation, PageVersion, Seam } from '@speedyspec-guide/domain';
import type { ExamplesFile } from '../examples.ts';
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
  config: { requireAllAssigned: boolean };
  /** `generated/examples.json`, or null when the runner stages did not run. */
  examples: ExamplesFile | null;
  /** The runtime's released versions (`speedyspec-php-runtime-v*` tags, without the prefix). */
  runtimeTags: string[];
}

/** One validation rule. Specification. */
export interface Rule {
  id: string;
  check(ctx: ValidationContext): Promise<Failure[]>;
}
