/**
 * The guide's build: `bun run guide <stage> [--offline]`, run from the repository root.
 * Stages: extract, fork, assign, graph, history, validate, or all of them in order.
 *
 * Inputs come from sources.json and checkouts under .cache/, or from GUIDE_WORDPRESS_DIR, GUIDE_FORK_DIR and
 * GUIDE_SERVER_DIR. Composition root.
 */
import { CompatFilesEvidence } from '@speedyspec-guide/adapter-compat-files-evidence';
import { GitTagHistory } from '@speedyspec-guide/adapter-git-tag-history';
import { PhpParserSource } from '@speedyspec-guide/adapter-php-parser-source';
import { SeamFiles } from '@speedyspec-guide/adapter-seam-files';
import { WordPressRelease } from '@speedyspec-guide/adapter-wordpress-release';
import { type PipelineDeps, runStage, STAGES, type Stage } from '@speedyspec-guide/app';
import type { GeneratedStore } from '@speedyspec-guide/contracts';
import { existsSync, mkdirSync } from 'node:fs';
import { join, resolve } from 'node:path';

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

function git(args: string[], cwd?: string): void {
  const p = Bun.spawnSync(['git', ...args], { cwd, stdout: 'pipe', stderr: 'pipe' });
  if (p.exitCode !== 0) throw new Error(`git ${args.join(' ')}: ${p.stderr.toString().trim()}`);
}

/** A checkout of `repo` at `commit` in `.cache/<name>`, made once. */
function checkout(cache: string, name: string, repo: string, commit: string): string {
  const dir = join(cache, `${name}-${commit.slice(0, 12)}`);
  if (!existsSync(dir)) {
    git(['clone', '--quiet', '--filter=blob:none', '--no-checkout', repo, dir]);
    git(['checkout', '--quiet', commit], dir);
  }
  return dir;
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

  const deps: PipelineDeps = {
    store: new GeneratedFiles(join(root, 'generated')),
    source: new PhpParserSource('php', config.stubFiles ?? []),
    seams: new SeamFiles(join(root, 'seams')),
    history: new GitTagHistory(sources.wordpress.tags, join(cache, 'wordpress-tags')),
    wordpressDir,
    forkDir,
    evidence: async () => new CompatFilesEvidence(await serverDir(), await wordpressDir(), await forkDir()),
    contentDir: join(root, 'content'),
    wordpressVersion: sources.wordpress.version,
    forkCommit: sources.fork.commit,
    config: { requireAllAssigned: config.requireAllAssigned },
  };

  for (const s of stage === 'all' ? STAGES : [stage as Stage]) {
    process.stderr.write(`guide: ${s}\n`);
    const result = await runStage(s, deps, { offline });
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
