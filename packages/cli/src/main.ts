/**
 * The guide's build: `bun run guide <stage> [--offline]`, run from the repository root.
 * Stages: extract, fork, assign, graph, history, validate, or all of them in order.
 *
 * Inputs come from sources.json and checkouts under .cache/, or from GUIDE_WORDPRESS_DIR, GUIDE_FORK_DIR and
 * GUIDE_SERVER_DIR. Composition root.
 */
import { CompatFilesEvidence } from '@speedyspec-guide/adapter-compat-files-evidence';
import { ContentFiles } from '@speedyspec-guide/adapter-content-files';
import { ExampleFiles } from '@speedyspec-guide/adapter-example-files';
import { RunnerCrate } from '@speedyspec-guide/adapter-runner-crate';
import { GitTagHistory } from '@speedyspec-guide/adapter-git-tag-history';
import { PhpParserSource } from '@speedyspec-guide/adapter-php-parser-source';
import { SeamFiles } from '@speedyspec-guide/adapter-seam-files';
import { WordPressRelease } from '@speedyspec-guide/adapter-wordpress-release';
import { type PipelineDeps, runStage, STAGES, type Stage } from '@speedyspec-guide/app';
import type { GeneratedStore } from '@speedyspec-guide/contracts';
import { existsSync, mkdirSync } from 'node:fs';
import { join, resolve } from 'node:path';
import { checkout } from './checkout.ts';

interface Sources {
  wordpress: { version: string; url: string; sha256: string; tags: string };
  server: { repo: string; commit: string };
  fork: { repo: string; branch: string; commit: string; path: string };
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
  const config = (await Bun.file(join(root, 'guide.config.json')).json()) as { requireAllAssigned: boolean; stubFiles?: string[] };
  const env = (name: string) => (process.env[name] ? resolve(process.env[name]!) : undefined);

  const wordpressDir = async () => env('GUIDE_WORDPRESS_DIR') ?? new WordPressRelease(sources.wordpress, cache).fetch(sources.wordpress.version);
  const forkDir = async () => {
    const dir = env('GUIDE_FORK_DIR');
    if (dir) return dir;
    try {
      return join(checkout(cache, 'fork', sources.fork.repo, sources.fork.commit), sources.fork.path);
    } catch (e) {
      throw new Error(`${(e as Error).message}\nThe fork commit may not be pushed yet; set GUIDE_FORK_DIR to a local packages/ folder.`);
    }
  };
  const serverDir = async () => env('GUIDE_SERVER_DIR') ?? checkout(cache, 'speedyspec-server', sources.server.repo, sources.server.commit);

  const seams = new SeamFiles(join(root, 'seams'));
  const runnerBinary = env('GUIDE_RUNNER') ?? join(root, 'runner', 'target', 'release', 'speedyspec-guide-examples');
  const runtimeVersion = async (isOffline: boolean) => {
    const cargo = await Bun.file(join(await serverDir(), 'crates', 'speedyspec-php-runtime', 'Cargo.toml')).text();
    const version = /^version\s*=\s*"([^"]+)"/m.exec(cargo)?.[1];
    if (!version) throw new Error('no version in speedyspec-php-runtime/Cargo.toml');
    if (isOffline) return { version, released: false };
    const tags = Bun.spawnSync(['git', 'ls-remote', '--tags', '--refs', sources.server.repo, `refs/tags/speedyspec-php-runtime-v${version}`]);
    if (tags.exitCode !== 0) throw new Error(`listing the server's tags: ${tags.stderr.toString().trim()}`);
    return { version, released: tags.stdout.toString().trim() !== '' };
  };

  const deps: PipelineDeps = {
    store: new GeneratedFiles(join(root, 'generated')),
    source: new PhpParserSource('php', config.stubFiles ?? []),
    seams,
    examples: { all: async () => new ExampleFiles(join(root, 'seams'), await seams.all()).all() },
    runner: existsSync(runnerBinary) ? new RunnerCrate(runnerBinary) : null,
    runtimeVersion,
    history: new GitTagHistory(sources.wordpress.tags, join(cache, 'wordpress-tags')),
    wordpressDir,
    forkDir,
    evidence: async () => new CompatFilesEvidence(await serverDir(), await wordpressDir(), await forkDir()),
    content: new ContentFiles(join(root, 'content')),
    wordpressVersion: sources.wordpress.version,
    forkCommit: sources.fork.commit,
    config: { requireAllAssigned: config.requireAllAssigned },
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
