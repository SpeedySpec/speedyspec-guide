# SpeedySpec Guide

Documentation for the WordPress API and the SpeedySpec API, by seam. See the design in
`wordpress-develop/docs/superpowers/specs/2026-11-20-speedyspec-guide-design.md`.

This repository holds the build toolchain (`packages/`), the seam map (`seams/`) and, later, the site and its content.

```bash
bun install
bun test
bun run typecheck
```

## The build

`bun run guide <stage> [--offline]`, from this folder. Each stage reads the previous stages' files in `generated/`:

| Stage | Writes |
|-------|--------|
| `extract` | `inventory-wp.json`: WordPress at the pinned trunk commit (`sources.json`), exported with `git archive` |
| `assign` | `assignment.json`: each symbol's seam, from `seams/*/seam.yaml` |
| `graph` | `graph.json` (dependencies, cross-seam edges), `cycles.json` (circular dependencies) |
| `history` | `wordpress-history.json`: since and removed, from WordPress's release tags (committed; skipped with `--offline`) |
| `examples` | `examples.json`: every example run on the sides it declares, compared with its `.expect.json` |
| `reflect` | `inventory-runtime.json`: the runtime's own PHP API (Reflection with its native areas, minus plain PHP) |
| `runtime-history` | `speedyspec-history.json`: each runtime symbol's since and removed (committed) |
| `validate` | `validation.json`; exits 1 and prints every failure |
| `all` | every stage in order |

Inputs are pinned in `sources.json`. Checkouts go to `.cache/`. For local runs, point at folders instead:

- `GUIDE_WORDPRESS_GIT`: a local clone of `WordPress/wordpress-develop` (its root, or a bare repository) to export
  the pinned commit's `src/` from, e.g. `wordpress-develop-original`. It is only read (`git archive`; no checkout,
  branch or fetch), so it must already have the commit. Without it, the guide fetches the commit into its own bare
  repository, `.cache/wordpress-git/`;
- `GUIDE_WORDPRESS_DIR`: an already exported WordPress `src/` folder, used as is;
- `GUIDE_SERVER_DIR`: a speedyspec-server checkout;
- `GUIDE_PLATFORM_DIR`: a speedyspec-platform checkout. speedyspec-server takes its shared crates and some compat
  areas (hooks, the contracts crates) from speedyspec-platform through crates.io, so `ss:` citations, tests and compat
  areas are looked up in the server first, then in the platform at its pin. Evidence links on the site go to whichever
  repository holds the crate or area (`generated/compat.json`'s `platform`).

`guide.config.json`: `requireAllAssigned` (fail when a symbol is in no seam) and `stubFiles` (files whose declarations
never replace a real one, like `wp-admin/includes/noop.php`).

### WordPress 7.1.5 (2026-11-20)

16,943 symbols (2,108 namespaced), 63,254 edges, 555 unresolved calls, no parse errors; 1,237 hook registrations
(289 to class methods); 243 circular groups holding 1,330 symbols, one of them only possible (it closes through a
hook-name pattern); 49 symbols in the Hooks seam; no seam cycles yet, because Hooks is the only seam.

## The examples runner

`runner/` is a Rust crate, `speedyspec-guide-examples`, that runs example files in the embedded PHP: on WordPress
(the seam's `wordpress` files loaded first) or on the runtime's native port. It links speedyspec-server's crates and
static PHP through the symlink `runner/server`, and the speedyspec-platform crates from crates.io at the versions the
server's workspace names (its `[workspace.dependencies]`, copied into `runner/Cargo.toml`):

```bash
GUIDE_PHP_BUILDROOT=<an existing .php-build/buildroot> bun run runner:link   # or build PHP in the pinned checkout
bun run runner:test
bun run runner:build
```

`GUIDE_RUNNER` points the pipeline at another binary. With `--offline` and no binary, the runner stages are skipped.

The runtime side boots every native area the runtime worker boots (`runner/src/sides.rs`; `tests/areas.rs` fails
when they differ). As in the worker, the database areas (wpdb, object cache, options, cron) boot only when the
environment names a database with the worker's variables: `DB_NAME`, `DB_USER`, `DB_PASSWORD`, `DB_HOST` and
`TABLE_PREFIX`. Run `bun run guide reflect` with them set, or `inventory-runtime.json` leaves that API out. Booting
only connects (`SELECT 1`); it creates no tables. Media reads always fail in the runner: it has no media-probe
children.

On Linux, speedyspec-server builds its static PHP for musl, so build PHP and the runner in a musl container with
`scripts/linux-runner.sh`, as CI does. The PHP build goes to `<server>/.php-build-linux` (`-arm64` on arm64), and the
runner comes out fully static, ready to run on the host:

```bash
scripts/linux-runner.sh bash -c 'cd .cache/speedyspec-server && scripts/build-php.sh'
GUIDE_PHP_BUILDROOT=.cache/speedyspec-server/.php-build-linux/buildroot bun run runner:link
scripts/linux-runner.sh bash -c 'cd runner && cargo test && cargo build --release'
GUIDE_RUNNER=runner/target/x86_64-unknown-linux-musl/release/speedyspec-guide-examples bun run guide examples
```

Examples live in `seams/<seam>/examples/<symbol>/<name>.php`, each with `<name>.expect.json`:
`{ "sides": ["wordpress", "runtime"], "output": "", "return": "20", "error": null }`. `return` is PHP's
`var_export()` of what the file returns (`"1"` when it returns nothing); an `error` ending in `*` matches by prefix.
`runtime` is allowed only in a ported seam.

A seam's `seam.yaml` may name a `setup` file, run after its `wordpress` files and before each example on the WordPress
side; it sees `GUIDE_MULTISITE`, which an example sets with `"multisite": true` (WordPress side only). A seam whose
examples need the database says `mysql: true`.

An API WordPress bundles but another project documents, such as sodium_compat (a polyfill of PHP's Sodium
extension), goes in its seam's `elsewhere` list: a `name`, an https `docs` link, the `files` that hold it (globs
allowed) and a `note`. The extract stage leaves those files' symbols out of `inventory-wp.json`, so no page is asked
for, and the seam's page links to the documentation instead.

```yaml
elsewhere:
  - name: "PHP's Sodium extension"
    docs: "https://www.php.net/manual/en/book.sodium.php"
    files: ["wp-includes/sodium_compat/**"]
    note: "WordPress bundles sodium_compat, a polyfill of the extension for servers without it."
```

### Some examples need MySQL

The seams with `mysql: true` (Options, Navigation menus) store through `$wpdb`, so their examples need a MySQL
database, given as `GUIDE_MYSQL_URL`. Each example gets fresh `guide_` tables: Options' `setup.php` recreates the four
tables it uses, and `seams/database.php` recreates every WordPress table from `wp_get_db_schema()`. Give it a database
of its own, never one holding a site. Without the variable, `bun run guide examples` stops before running anything.

```bash
docker run -d --name guide-mysql -e MYSQL_ROOT_PASSWORD=password -e MYSQL_DATABASE=guide_examples -p 3307:3306 mysql:8.4
```

```bash
export GUIDE_MYSQL_URL=mysql://root:password@127.0.0.1:3307/guide_examples
```

Without Docker, a local `mysqld` (such as Homebrew's) works too: initialize a data directory with
`mysqld --initialize-insecure --datadir=<dir>`, start it on a free port, and create a database and user for the guide.

Seams that only read and write options, such as Cron and Recovery mode, need no database: `seams/cached-options.php`
keeps their options in the object cache.

CI runs a MySQL 8.4 service for the examples job and the nightly run.

First run (2026-11-20): `hooks/add_filter/change-a-value` passes on both sides; the runtime's own API is 181 symbols (including `SpeedySpec\Hooks\Hook`), all unreleased until the first `speedyspec-php-runtime-v*` tag.

## The site

`site/` is the Astro site. It reads `generated/`, `seams/` and `content/` (or `GUIDE_DATA_DIR`, `GUIDE_SEAMS_DIR`,
`GUIDE_CONTENT_DIR`) and builds static pages:

- `/wordpress/<seam>/…`: the WordPress API by seam;
- `/speedyspec/<seam>/…`: verdicts, differences, dependencies and cycles, porting and architecture pages, and
  `/speedyspec/runtime/` for runtime API not yet in a seam;
- `/coverage/`: how much of each seam is written, and what is in no seam yet.

```bash
bunx playwright install chromium   # once: Mermaid diagrams are rendered at build time
bun run site:dev
bun run site:build                 # astro build, then Pagefind for search
```

Hand-written pages are MDX: `content/<wordpress|speedyspec>/<seam>/<slug>.mdx` with `symbol:` in the front matter
(SpeedySpec pages add `verdict:` and `differences:`), and `_seam.mdx`, `_porting.mdx`, `_architecture.mdx` per seam.
In them, `<Ev …/>` cites evidence and `<Changed version="…">` records a change. Examples render from
`seams/<seam>/examples/`.

The installation guide is `content/install/<slug>.mdx`, apart from the seams, with `title:`, `order:` and
`summary:` in the front matter. It is served at `/install/` (the page `index.mdx`) and `/install/<slug>/`, in `order`.

`docker build -f site/Dockerfile .` builds an image serving the site.

First real build (2026-11-20): 61 pages in 4 seconds, 57 of them indexed for search.

## The Hooks seam (2026-11-20)

Fully documented and enforced (`requirePortedCoverage`): all 29 WordPress members have a WordPress page and a
SpeedySpec page, `WP_Hook`'s 20 methods are documented on its class page, and SpeedySpec's own 47 Hooks symbols
have SpeedySpec pages. 129 MDX pages; 76 examples, 148 runs (WordPress 7.1.5 and the runtime), all passing; every
documented break has a porting before/after pair. Findings (incompatibilities the guide found that speedyspec-server doesn't record yet): five, in [docs/hooks-findings.md](docs/hooks-findings.md).

## The seam map (2026-11-21)

Every WordPress 7.1.5 symbol is in exactly one seam: 16,943 symbols in 43 WordPress seams, none unassigned and no
conflicts (`requireAllAssigned` is on). Most seams are one per package of SpeedySpec's fork (`packages/wp-*`, via
`forkPackages`). On top of those are `plugins` (split from Hooks' package), `admin`, `bundled` (wp-content), `entry-points` (the root
PHP files) and `ai-client` (WordPress 7.1.5 code the fork doesn't have yet). A symbol the fork doesn't hold goes by
its file; a hook or global used by several seams goes to the first in WordPress's load order (`wp-settings.php`).

- **Largest seams:** admin (1,876), password (1,182), rest-api (1,106), theme (1,068), ai-client (1,042), block (908),
  feed (884), app-upgrader (865), query (840), media (786).
- **Ported seams:**
  - Hooks is fully documented (30 of 30 members on both sides).
  - Its one cross-seam dependency is `_deprecated_hook`, reached through the `DeprecatedHooks` port; its PHP adapter
    calls WordPress's function (`DependencyStateRecorded`).
  - `WP_Hook`'s ten runtime-only methods are listed and documented (`RuntimeMembersListed`).
- **SpeedySpec-only seams:**
  - **Container** (52 runtime symbols) and **Plugin registry** (8) exist only under `/speedyspec/`.
  - Their seam and architecture pages are written. Their symbols have generated pages (signature, added in), not
    written ones yet.
  - Every symbol the runtime registers is now in a seam.
- **Unported seams** have generated pages only. Their written coverage is 0, which is allowed.

Build at full size: 12,227 pages in about 5 minutes (peak memory 1.1 GB, 453 MB of HTML, 2.85 million internal links).
- **Page size:** the only pages over 400 KB are WordPress seam pages with an inline diagram.
- **Diagrams:**
  - A diagram over 150 nodes or 300 links, or one Mermaid can't lay out in 30 seconds, is shown as "too large to
    draw".
  - Past the link cap, each other seam's links collapse to one per direction.
- **Dependency and cycle lists:** a seam page shows each list's top rows; the full lists have their own pages.
- **`bun run guide all`:** about 70 minutes from an empty `generated/`, almost all of it the `history` stage walking
  WordPress's release tags.

## WordPress trunk, and no fork (2026-11-21)

The guide now documents upstream WordPress trunk, pinned in `sources.json`: `WordPress/wordpress-develop` at
`ce78d2d6eb` (7.2-RC1), `src/` exported with `git archive` into `.cache/wordpress-<commit>/`. It reads git objects
only, so no checkout's working tree or branch is touched. SpeedySpec's PHP `packages/` tree is no longer read: it
won't ship in SpeedySpec.

- **Inventory:** 17,693 symbols (7.1.5 had 16,943), 70,530 edges, no parse errors, in 43 WordPress seams.
  - The new seam is **Entity fields and actions** (7.2's entity API), and new trunk files joined their seams.
  - `web-public` (one TinyMCE loader function) joined `editor`.
  - Seams no longer name PHP packages (`packages:`); architecture diagrams show SpeedySpec's crates only.
- **Seams:** each seam that used a fork package now lists its WordPress files (505 files). The 47 symbols whose file
  went to another seam are listed by id, so no symbol changed seam. An exact file beats a glob, and a seam may not
  name a file WordPress doesn't have (`SeamFilesExist`).
- **Verdicts:**
  - A symbol in an unported seam is **Not in SpeedySpec yet**. It has no SpeedySpec page of its own; its seam's
    SpeedySpec page lists it.
  - The fork stage and its verdicts (same code, modified, removed) are gone.
- **Provenance:** claims verified by a compat scenario say *verified against WordPress 7.1.5* (the release
  speedyspec-server's compat is recorded on, `generated/compat.json`); claims read from source say *read from
  WordPress 7.2-RC1 (trunk ce78d2d)*. A symbol in no release tag yet says so.
- **Trunk against 7.1.5:**
  - All 167 example runs pass on trunk, so no Hooks behaviour the guide documents changed.
  - The 9 `wp:` citations moved with trunk's code and are re-hashed.
- **Build:** 11,553 pages in about 5 minutes, about 443 MB, 2.92 million internal links, 0 dead. The only pages over
  400 KB are WordPress seam pages with a diagram.

## Options, WordPress side (2026-11-21)

The Options seam is documented on its WordPress side; its SpeedySpec side stays *Not in SpeedySpec yet* until
speedyspec-server's worker boots its Options port.

- **Pages:** all 106 Options symbols have a WordPress page: 47 functions, 4 globals, 27 filters and 28 actions.
  `requireWordPressCoverage: ["options"]` in `guide.config.json` keeps it so (`DocumentedSeamCovered`).
- **Examples:** 104, every one run on WordPress trunk against MySQL (see "Options examples need MySQL"), 21 of them
  on a multisite install. `seams/options/setup.php` gives each one fresh tables.
- **Evidence:** pages cite 78 of the 113 scenarios in speedyspec-server's `compat/options`, and trunk source where no
  scenario covers a claim (the user settings, and what trunk changed). The evidence index and the compat release now
  cover every seam with a compat area, ported or not.
- **Trunk against 7.1.5:** `get_option()` also untrailingslashes `wp_random_base`, `wp_load_core_site_options()` no
  longer primes `can_compress_scripts`, and `register_initial_settings()` exposes settings to the Abilities API and
  registers `wp_page_for_privacy_policy`. Each page says what 7.1.5 did.
- **Rust or PHP:** `/speedyspec/conversion/` says, for each WordPress function, class, method and constant, whether
  it is Rust in the runtime, Rust in a server port the runtime doesn't load yet, or PHP (stage `conversion`, from the
  runtime's Reflection and the ports' PHP facades). At the pinned server: Hooks 42 in the runtime; Options 38,
  Object Cache 44 and wpdb 77 ported but not loaded.

## Compat on WordPress 7.2-RC2 (2026-11-25)

speedyspec-server `786dc5febc75` (#117) records every compat area from WordPress 7.2-RC2, the release the guide's
WordPress pin (`sources.json`, wordpress-develop `1ccce2133e92`) already is.

- **The compat pin is one table:** speedyspec-server's `compat/wordpress.json` names the pinned release and each
  release's tarball and SHA-256. An area's `compat/<area>/source.json` is `{}`, or overrides only the version. The
  evidence source reads the override, else the table's pin, so `generated/compat.json` lists every seam with a compat
  area of its name (cron, hooks, i18n, media, meta, object cache, options, password, shortcode, text diff), each at
  7.2-RC2. Claims verified by a scenario now say *verified against WordPress 7.2-RC2*.
- **Trunk against 7.1.5 is closed:** the three Options differences the guide found are ported, so those pages say
  works as WordPress.

## The meta seam, native (2026-11-26)

speedyspec-server `43bb14a3` (PR #131) wires WordPress's metadata API into the runtime, and the guide now pins
speedyspec-platform too (`fe3bb527`), where the shared crates and the hooks compat area moved.

- **Meta is a ported seam:** 23 of `meta.php`'s 24 functions and `WP_Metadata_Lazyloader` are native; `get_meta_sql()`
  stays WordPress's PHP until `WP_Meta_Query` is ported. Every function, hook and `$wp_meta_keys` has a SpeedySpec
  page citing the `compat/metadata` scenarios (101 single site, 5 multisite) and WordPress's meta PHPUnit tests (339
  and 343). The runtime's own meta API (the natives, the PHP helpers and the repository twins) is listed in the seam.
- **Differences:** `update_meta_cache()`'s query also selects the meta id; on a single site `site` meta maps to
  `wp_sitemeta`; objects in meta values reach hooks as copies; `default_{$meta_type}_metadata` gets an `absint()`ed
  id. Every recorded scenario replays exactly (101 single site, 5 multisite); no break is recorded.
- **The platform split:** citations into crates that moved resolve in the platform checkout, 15 tests that moved to
  other crates are re-cited, and the runner takes the platform crates from crates.io and boots `MetaArea` as the
  worker does.

## Post reading, native (2026-11-27)

speedyspec-server `05887e84` (the merge of PR #136, phase 4 of the posts and meta port) makes 55 of `post.php`'s
functions native: the post type and post status registries and post reading. The guide pins speedyspec-platform at
`bf2962ce`, the release of speedyspec-wp-posts-contracts 0.3.1 (the `Posts` read contract, with `server` time's
fraction) and speedyspec-php 0.8.1, and the runner boots `PostsArea` as the worker does.

- **Query stays an unported seam** (comments, `WP_Query` and the post writes are WordPress's PHP), but every ported
  function has a SpeedySpec page with its verdict, citing the `compat/posts-read` scenarios (191 single site, 5
  multisite, all replaying exactly) and WordPress's post PHPUnit tests (235 and 235). The runtime's own post API (55
  natives, `post_instance()` (the body the prepared release gives `WP_Post::get_instance()`), 21 PHP helpers, and the
  `SpeedySpec\WpPosts\PostRepository` and `SpeedySpec\WpPosts\Taxonomy` twins) is listed in the seam.
- **Differences:** the meta statement selects `meta_id` too; `_prime_post_caches()` and
  `_prime_post_parent_id_caches()` drop a negative id; the readers beside `get_post()` read an object argument as a
  copy; objects handed to a reading function's hook callbacks are
  copies. Open: row order on MySQL 8.4. The `server` time break is gone with posts-contracts 0.3.1.
