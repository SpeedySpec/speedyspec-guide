import type { EvidenceSource } from '@speedyspec-guide/contracts';
import type { Assignment, Inventory, Seam } from '@speedyspec-guide/domain';
import type { HistoryFile } from '../history.ts';
import type { PageCitation, PageVersion } from './citations-in-content.ts';

export interface Failure {
  rule: string;
  where: string;
  message: string;
}

export interface ValidationContext {
  inventory: Inventory;
  assignment: Assignment;
  seams: Seam[];
  citations: PageCitation[];
  evidence: EvidenceSource;
  history: HistoryFile;
  versionsOnPages: PageVersion[];
  config: { requireAllAssigned: boolean };
}

/** One validation rule. Specification. */
export interface Rule {
  id: string;
  check(ctx: ValidationContext): Promise<Failure[]>;
}
