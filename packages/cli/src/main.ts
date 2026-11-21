/**
 * The guide's build: `bun run guide <stage> [--offline]`, run from the repository root.
 * Stages: extract, assign, graph, history, validate, or all of them in order.
 *
 * Inputs come from sources.json and checkouts under .cache/, or from GUIDE_WORDPRESS_GIT, GUIDE_WORDPRESS_DIR and
 * GUIDE_SERVER_DIR. Composition root.
 */
import { CompatFilesEvidence } from '@speedyspec-guide/adapter-compat-files-evidence';
import { ContentFiles } from '@speedyspec-guide/adapter-content-files';
import { ExampleFiles } from '@speedyspec-guide/adapter-example-files';
import { RunnerCrate } from '@speedyspec-guide/adapter-runner-crate';
import { GitTagHistory } from '@speedyspec-guide/adapter-git-tag-history';
import { PhpParserSource } from '@speedyspec-guide/adapter-php-parser-source';
import { SeamFiles } from '@speedyspec-guide/adapter-seam-files';
import { WordPressCommit } from '@speedyspec-guide/adapter-wordpress-git';
import { type PipelineDeps, runStage, STAGES, type Stage } from '@speedyspec-guide/app';
import type { GeneratedStore } from '@speedyspec-guide/contracts';
import { existsSync, mkdirSync, mkdtempSync } from 'node:fs';
import { tmpdir } from 'node:os';
import { join, resolve } from 'node:path';
import { checkout } from './checkout.ts';

interface Sources {
  wordpress: { repo: string; commit: string; version: string; path: string; tags: string };
  server: { repo: string; commit: string };
}

class GeneratedFiles implements GeneratedStore {
  constructor(private readonly dir: string) {}
  async read<T>(name: string): Promise<T | null> {
    const f = Bun.file(join(this.dir, `${name}.json`));
    return (await f.exists()) ? ((await f.json()) as T) : null;
  }
  async write(name: string, data: unknown): Promise<void> {
    mkdirSync(this.dir, { recursive: true });
    await Bun.write(join(this.dir, `${name}.json`), `${JSON.stringify(data)}\n`);
  }
}

async function main(argv: string[]): Promise<number> {
  const offline = argv.includes('--offline');
  const stage = argv.find((a) => !a.startsWith('--'));
  const valid = [...STAGES, 'all'];
  if (stage === undefined || !valid.includes(stage)) {
    process.stderr.write(`usage: bun run guide <stage> [--offline]\nstages: ${valid.join(', ')}\n`);
    return 2;
  }

  const root = process.cwd();
  const cache = join(root, '.cache');
  const sources = (await Bun.file(join(root, 'sources.json')).json()) as Sources;
  const config = (await Bun.file(join(root, 'guide.config.json')).json()) as { requireAllAssigned: boolean; requirePortedCoverage?: boolean; requireWordPressCoverage?: string[]; stubFiles?: string[] };
  const env = (name: string) => (process.env[name] ? resolve(process.env[name]!) : undefined);

  // WordPress is the pinned commit's src/, exported from a local git directory: GUIDE_WORDPRESS_GIT (any clone of
  // wordpress-develop, only read, never fetched into), else the guide's own .cache/wordpress-git, which it fetches into.
  const givenGit = env('GUIDE_WORDPRESS_GIT');
  const wordpressDir = async () =>
    env('GUIDE_WORDPRESS_DIR') ??
    new WordPressCommit(sources.wordpress, cache, givenGit ?? join(cache, 'wordpress-git'), undefined, { fetch: givenGit === undefined }).fetch(sources.wordpress.version);
  const serverDir = async () => env('GUIDE_SERVER_DIR') ?? checkout(cache, 'speedyspec-server', sources.server.repo, sources.server.commit);

  const seams = new SeamFiles(join(root, 'seams'));
  const runnerBinary = env('GUIDE_RUNNER') ?? join(root, 'runner', 'target', 'release', 'speedyspec-guide-examples');
  const serverTags = new GitTagHistory(sources.server.repo, join(cache, 'server-tags'), 'speedyspec-php-runtime-v');
  const runtimeTags = async (isOffline: boolean): Promise<string[]> => (isOffline ? [] : serverTags.tags());
  const runtimeVersion = async (isOffline: boolean) => {
    const cargo = await Bun.file(join(await serverDir(), 'crates', 'speedyspec-php-runtime', 'Cargo.toml')).text();
    const version = /^version\s*=\s*"([^"]+)"/m.exec(cargo)?.[1];
    if (!version) throw new Error('no version in speedyspec-php-runtime/Cargo.toml');
    // With GUIDE_SERVER_DIR the "pin" is whatever that checkout is at.
    const dir = env('GUIDE_SERVER_DIR');
    const pinnedCommit = dir ? Bun.spawnSync(['git', '-C', dir, 'rev-parse', 'HEAD']).stdout.toString().trim() : sources.server.commit;
    return { version, pinnedCommit, tagCommit: isOffline ? null : await serverTags.tagCommit(version) };
  };

  const deps: PipelineDeps = {
    store: new GeneratedFiles(join(root, 'generated')),
    source: new PhpParserSource('php', config.stubFiles ?? []),
    seams,
    examples: { all: async () => new ExampleFiles(join(root, 'seams'), await seams.all()).all() },
    runner: existsSync(runnerBinary) ? new RunnerCrate(runnerBinary) : null,
    mysqlUrl: process.env.GUIDE_MYSQL_URL ?? null,
    runtimeVersion,
    runtimeTags,
    history: new GitTagHistory(sources.wordpress.tags, join(cache, 'wordpress-tags')),
    wordpressDir,
    wordpressFile: async (rel: string) => Bun.file(join(await wordpressDir(), rel)).text(),
    evidence: async () => new CompatFilesEvidence(await serverDir(), await wordpressDir()),
    content: new ContentFiles(join(root, 'content')),
    crates: {
      manifests: async () => {
        const dir = join(await serverDir(), 'crates');
        const out: { path: string; text: string }[] = [];
        for await (const file of new Bun.Glob('*/Cargo.toml').scan({ cwd: dir })) out.push({ path: file, text: await Bun.file(join(dir, file)).text() });
        return out;
      },
      facades: async () => {
        const dir = join(await serverDir(), 'crates');
        const out = mkdtempSync(join(tmpdir(), 'guide-facades-'));
        for await (const file of new Bun.Glob('speedyspec-wp-*-php/src/*.php').scan({ cwd: dir })) {
          // The runtime evals these, so they start without an opening tag; the extractor needs one.
          const text = await Bun.file(join(dir, file)).text();
          await Bun.write(join(out, file.replaceAll('/', '--')), text.trimStart().startsWith('<?php') ? text : `<?php\n${text}`);
        }
        return out;
      },
    },
    wordpressVersion: sources.wordpress.version,
    config: { requireAllAssigned: config.requireAllAssigned, requirePortedCoverage: config.requirePortedCoverage === true, requireWordPressCoverage: config.requireWordPressCoverage ?? [] },
  };

  for (const s of stage === 'all' ? STAGES : [stage as Stage]) {
    process.stderr.write(`guide: ${s}\n`);
    const result = await runStage(s, deps, { offline });
    if (result.skipped) process.stderr.write(`guide: ${s} skipped: ${result.skipped}\n`);
    for (const f of result.failures) process.stdout.write(`${f.rule} ${f.where}: ${f.message}\n`);
    if (!result.ok) {
      process.stderr.write(`guide: ${s} failed with ${result.failures.length} problem(s)\n`);
      return 1;
    }
  }
  return 0;
}

main(process.argv.slice(2)).then(
  (code) => process.exit(code),
  (e: Error) => {
    process.stderr.write(`guide: ${e.message}\n`);
    process.exit(1);
  },
);
