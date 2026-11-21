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
| `extract` | `inventory-wp.json` (WordPress 7.1.5), `inventory-ss.json` (SpeedySpec's `packages/` fork) |
| `fork` | `fork.json`: same, modified, removed or added, per function, class and method |
| `assign` | `assignment.json`: each symbol's seam, from `seams/*/seam.yaml` |
| `graph` | `graph.json` (dependencies, cross-seam edges), `cycles.json` (circular dependencies) |
| `history` | `wordpress-history.json`: since and removed, from WordPress's release tags (committed; skipped with `--offline`) |
| `examples` | `examples.json`: every example run on the sides it declares, compared with its `.expect.json` |
| `reflect` | `inventory-runtime.json`: the runtime's own PHP API (Reflection with its native areas, minus plain PHP) |
| `runtime-history` | `speedyspec-history.json`: each runtime symbol's since and removed (committed) |
| `validate` | `validation.json`; exits 1 and prints every failure |
| `all` | every stage in order |

Inputs are pinned in `sources.json`. Checkouts go to `.cache/`. For local runs, point at folders instead:

- `GUIDE_WORDPRESS_DIR`: an extracted WordPress release;
- `GUIDE_FORK_DIR`: the fork's `packages/` folder, e.g. from
  `git -C <wordpress-develop> archive <commit> packages | tar -x -C .cache/fork-local`;
- `GUIDE_SERVER_DIR`: a speedyspec-server checkout.

`guide.config.json`: `requireAllAssigned` (fail when a symbol is in no seam) and `stubFiles` (files whose declarations
never replace a real one, like `wp-admin/includes/noop.php`).

### WordPress 7.1.5 (2026-11-20)

16,943 symbols (2,108 namespaced), 63,254 edges, 555 unresolved calls, no parse errors; 1,237 hook registrations
(289 to class methods); 243 circular groups holding 1,330 symbols, one of them only possible (it closes through a
hook-name pattern); 49 symbols in the Hooks seam; no seam cycles yet, because Hooks is the only seam.

## The examples runner

`runner/` is a Rust crate, `speedyspec-guide-examples`, that runs example files in the embedded PHP: on WordPress
(the seam's `wordpress` files loaded first) or on the runtime's native port. It links speedyspec-server's crates and
static PHP through the symlink `runner/server`:

```bash
GUIDE_PHP_BUILDROOT=<an existing .php-build/buildroot> bun run runner:link   # or build PHP in the pinned checkout
bun run runner:test
bun run runner:build
```

`GUIDE_RUNNER` points the pipeline at another binary. With `--offline` and no binary, the runner stages are skipped.

Examples live in `seams/<seam>/examples/<symbol>/<name>.php`, each with `<name>.expect.json`:
`{ "sides": ["wordpress", "runtime"], "output": "", "return": "20", "error": null }`. `return` is PHP's
`var_export()` of what the file returns (`"1"` when it returns nothing); an `error` ending in `*` matches by prefix.
`runtime` is allowed only in a ported seam.

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

`docker build -f site/Dockerfile .` builds an image serving the site.

First real build (2026-11-20): 61 pages in 4 seconds, 57 of them indexed for search.

## The Hooks seam (2026-11-20)

Fully documented and enforced (`requirePortedCoverage`): all 29 WordPress members have a WordPress page and a
SpeedySpec page, `WP_Hook`'s 20 methods are documented on its class page, and SpeedySpec's own 47 Hooks symbols
have SpeedySpec pages. 129 MDX pages; 76 examples, 148 runs (WordPress 7.1.5 and the runtime), all passing; every
documented break has a porting before/after pair. Findings (incompatibilities the guide found that speedyspec-server doesn't record yet): four, in [docs/hooks-findings.md](docs/hooks-findings.md).

## The seam map (2026-11-21)

Every WordPress 7.1.5 symbol is in exactly one seam: 16,943 symbols in 43 WordPress seams, none unassigned and no
conflicts (`requireAllAssigned` is on). Most seams are one per package of SpeedySpec's fork (`packages/wp-*`, via
`forkPackages`). On top of those are `plugins` (split from Hooks' package), `admin`, `bundled` (wp-content), `entry-points` (the root
PHP files) and `ai-client` (WordPress 7.1.5 code the fork doesn't have yet). A symbol the fork doesn't hold goes by
its file; a hook or global used by several seams goes to the first in WordPress's load order (`wp-settings.php`).

- **Outside the fork:** `admin` and `bundled` are `inFork: false`, because SpeedySpec's `packages/` tree doesn't
  carry wp-admin or wp-content. Their symbols get no "removed" verdict, and their SpeedySpec seam pages say so
  instead of listing every symbol.
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
