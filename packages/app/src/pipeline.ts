import type { ContentPages, CrateSource, EvidenceSource, ExampleRunner, ExampleSource, GeneratedStore, ReleaseHistory, SeamRepository, SymbolSource } from '@speedyspec-guide/contracts';
import type { Assignment, GuideSymbol, Inventory } from '@speedyspec-guide/domain';
import { assign } from './assign.ts';
import { loadOrder } from './load-order.ts';
import { computeCoverage } from './coverage.ts';
import { buildEvidenceIndex, type EvidenceIndex } from './evidence-index.ts';
import { readCrates } from './crates.ts';
import { findCycles } from './cycles.ts';
import { compareFork } from './fork.ts';
import { type ExamplesFile, exampleFailures, runExamples, runtimeApi } from './examples.ts';
import { buildGraph } from './graph.ts';
import { releasedAt, type RuntimeHistoryFile, updateRuntimeHistory } from './runtime-history.ts';
import { computeHistory, type HistoryFile } from './history.ts';
import type { Failure } from './validate/rule.ts';
import { ALL_RULES, runRules } from './validate/run.ts';

export const STAGES = ['extract', 'fork', 'assign', 'graph', 'history', 'examples', 'reflect', 'runtime-history', 'crates', 'coverage', 'evidence', 'validate'] as const;
export type Stage = (typeof STAGES)[number];

/** What the stages need from outside. The CLI wires the adapters. */
export interface PipelineDeps {
  store: GeneratedStore;
  source: SymbolSource;
  seams: SeamRepository;
  history: ReleaseHistory;
  wordpressDir(): Promise<string>;
  /** A file of the WordPress release, by its path in the release. */
  wordpressFile(rel: string): Promise<string>;
  forkDir(): Promise<string>;
  evidence(): Promise<EvidenceSource>;
  content: ContentPages;
  crates: CrateSource;
  examples: ExampleSource;
  /** Null when the runner binary is not built. */
  runner: ExampleRunner | null;
  /**
   * The PHP runtime's version at the pinned server, the pinned commit, and the commit the version's tag points to
   * (null when it has no tag, or offline).
   */
  runtimeVersion(offline: boolean): Promise<{ version: string; pinnedCommit: string; tagCommit: string | null }>;
  /** The runtime's released versions; none when offline. */
  runtimeTags(offline: boolean): Promise<string[]>;
  wordpressVersion: string;
  forkCommit: string;
  config: { requireAllAssigned: boolean; requirePortedCoverage?: boolean };
}

export interface StageResult {
  ok: boolean;
  failures: Failure[];
  /** Why the stage did nothing, when it was skipped. */
  skipped?: string;
}

async function need<T>(store: GeneratedStore, name: string): Promise<T> {
  const v = await store.read<T>(name);
  if (v === null) throw new Error(`generated/${name}.json is missing; run an earlier stage first`);
  return v;
}

const EMPTY_HISTORY: HistoryFile = { tags: [], symbols: {} };
const RUNNER_STAGES: Stage[] = ['examples', 'reflect', 'runtime-history'];

/** Runs one stage: it reads earlier stages' outputs from the store and writes its own. Pipes and Filters. */
export async function runStage(stage: Stage, deps: PipelineDeps, opts: { offline: boolean }): Promise<StageResult> {
  const { store } = deps;
  if (RUNNER_STAGES.includes(stage) && deps.runner === null) {
    if (opts.offline) return { ok: true, failures: [], skipped: 'no runner binary (bun run runner:build)' };
    throw new Error('the examples runner is not built; run bun run runner:link && bun run runner:build');
  }
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
      await store.write(
        'assignment',
        assign(await need<Inventory>(store, 'inventory-wp'), await deps.seams.all(), await need<Inventory>(store, 'inventory-ss'), loadOrder(await deps.wordpressFile('wp-settings.php'))),
      );
      break;
    case 'graph': {
      const a = await need<Assignment>(store, 'assignment');
      const g = buildGraph(await need<Inventory>(store, 'inventory-wp'), a);
      await store.write('graph', g);
      await store.write('cycles', findCycles(g));
      break;
    }
    case 'history':
      if (!opts.offline) {
        const cache = (await store.read<HistoryFile>('wordpress-history')) ?? EMPTY_HISTORY;
        const save = (h: HistoryFile) => store.write('wordpress-history', h);
        await save(await computeHistory(deps.history, deps.source, cache, save));
      }
      break;
    case 'examples': {
      const seams = await deps.seams.all();
      const file = await runExamples(deps.examples, deps.runner!, seams, await deps.wordpressDir());
      await store.write('examples', file);
      const failures = exampleFailures(file, file.declared).map((f) => ({ rule: 'ExampleHasRun', ...f }));
      return { ok: failures.length === 0, failures };
    }
    case 'reflect':
      await store.write('inventory-runtime', await runtimeApi(deps.runner!));
      break;
    case 'runtime-history': {
      const { version, pinnedCommit, tagCommit } = await deps.runtimeVersion(opts.offline);
      const released = releasedAt(pinnedCommit, tagCommit);
      const file = (await store.read<RuntimeHistoryFile>('speedyspec-history')) ?? { versions: [], symbols: {} };
      await store.write('speedyspec-history', updateRuntimeHistory(await need<GuideSymbol[]>(store, 'inventory-runtime'), version, released, file));
      break;
    }
    case 'crates':
      await store.write('crates', readCrates(await deps.crates.manifests()));
      break;
    case 'coverage':
      await store.write('coverage', computeCoverage(await need<Assignment>(store, 'assignment'), await deps.seams.all(), await deps.content.pages()));
      break;
    case 'evidence':
      await store.write('evidence-index', await evidenceIndexes(deps));
      break;
    case 'validate': {
      const failures = await runRules(ALL_RULES, {
        inventory: await need<Inventory>(store, 'inventory-wp'),
        assignment: await need<Assignment>(store, 'assignment'),
        seams: await deps.seams.all(),
        pages: await deps.content.pages(),
        citations: await deps.content.citations(),
        evidence: await deps.evidence(),
        history: (await store.read<HistoryFile>('wordpress-history')) ?? EMPTY_HISTORY,
        versionsOnPages: await deps.content.versions(),
        config: deps.config,
        examples: await store.read<ExamplesFile>('examples'),
        declaredExamples: (await deps.examples.all()).examples.map((e) => ({ id: e.id, sides: e.sides })),
        // Offline, the released versions are those recorded in the committed speedyspec-history.json.
        evidenceIndex: await evidenceIndexes(deps),
        runtimeIds: (await store.read<GuideSymbol[]>('inventory-runtime'))?.map((s) => s.id) ?? null,
        runtimeTags: opts.offline
          ? ((await store.read<RuntimeHistoryFile>('speedyspec-history'))?.versions ?? [])
          : await deps.runtimeTags(opts.offline),
      });
      await store.write('validation', failures);
      return { ok: failures.length === 0, failures };
    }
  }
  return { ok: true, failures: [] };
}

/** The evidence index of every ported seam that has a compat area of its name. */
async function evidenceIndexes(deps: PipelineDeps): Promise<Record<string, EvidenceIndex>> {
  const evidence = await deps.evidence();
  const out: Record<string, EvidenceIndex> = {};
  for (const seam of (await deps.seams.all()).filter((s) => s.ported)) {
    const c = await evidence.catalogue(seam.id);
    if (c) out[seam.id] = buildEvidenceIndex(seam.id, c);
  }
  return out;
}
