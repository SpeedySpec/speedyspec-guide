import type { EvidenceSource, GeneratedStore, ReleaseHistory, SeamRepository, SymbolSource } from '@speedyspec-guide/contracts';
import type { Assignment, Inventory } from '@speedyspec-guide/domain';
import { assign } from './assign.ts';
import { findCycles } from './cycles.ts';
import { compareFork } from './fork.ts';
import { buildGraph } from './graph.ts';
import { computeHistory, type HistoryFile } from './history.ts';
import { citationsIn, versionsIn } from './validate/citations-in-content.ts';
import type { Failure } from './validate/rule.ts';
import { ALL_RULES, runRules } from './validate/run.ts';

export const STAGES = ['extract', 'fork', 'assign', 'graph', 'history', 'validate'] as const;
export type Stage = (typeof STAGES)[number];

/** What the stages need from outside. The CLI wires the adapters. */
export interface PipelineDeps {
  store: GeneratedStore;
  source: SymbolSource;
  seams: SeamRepository;
  history: ReleaseHistory;
  wordpressDir(): Promise<string>;
  forkDir(): Promise<string>;
  evidence(): Promise<EvidenceSource>;
  contentDir: string;
  wordpressVersion: string;
  forkCommit: string;
  config: { requireAllAssigned: boolean };
}

export interface StageResult {
  ok: boolean;
  failures: Failure[];
}

async function need<T>(store: GeneratedStore, name: string): Promise<T> {
  const v = await store.read<T>(name);
  if (v === null) throw new Error(`generated/${name}.json is missing; run an earlier stage first`);
  return v;
}

const EMPTY_HISTORY: HistoryFile = { tags: [], symbols: {} };

/** Runs one stage: it reads earlier stages' outputs from the store and writes its own. Pipes and Filters. */
export async function runStage(stage: Stage, deps: PipelineDeps, opts: { offline: boolean }): Promise<StageResult> {
  const { store } = deps;
  switch (stage) {
    case 'extract': {
      await store.write('inventory-wp', await deps.source.extract(await deps.wordpressDir(), 'wp', deps.wordpressVersion));
      await store.write('inventory-ss', await deps.source.extract(await deps.forkDir(), 'ss', deps.forkCommit));
      break;
    }
    case 'fork':
      await store.write('fork', compareFork(await need<Inventory>(store, 'inventory-wp'), await need<Inventory>(store, 'inventory-ss')));
      break;
    case 'assign':
      await store.write('assignment', assign(await need<Inventory>(store, 'inventory-wp'), await deps.seams.all()));
      break;
    case 'graph': {
      const a = await need<Assignment>(store, 'assignment');
      const g = buildGraph(await need<Inventory>(store, 'inventory-wp'), a);
      await store.write('graph', g);
      await store.write('cycles', findCycles(g, a));
      break;
    }
    case 'history':
      if (!opts.offline) {
        const cache = (await store.read<HistoryFile>('wordpress-history')) ?? EMPTY_HISTORY;
        await store.write('wordpress-history', await computeHistory(deps.history, deps.source, cache));
      }
      break;
    case 'validate': {
      const failures = await runRules(ALL_RULES, {
        inventory: await need<Inventory>(store, 'inventory-wp'),
        assignment: await need<Assignment>(store, 'assignment'),
        seams: await deps.seams.all(),
        citations: await citationsIn(deps.contentDir),
        evidence: await deps.evidence(),
        history: (await store.read<HistoryFile>('wordpress-history')) ?? EMPTY_HISTORY,
        versionsOnPages: await versionsIn(deps.contentDir),
        config: deps.config,
      });
      await store.write('validation', failures);
      return { ok: failures.length === 0, failures };
    }
  }
  return { ok: true, failures: [] };
}
