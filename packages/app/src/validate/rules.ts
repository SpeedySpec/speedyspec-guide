import { type Citation, citationText, type Guide } from '@speedyspec-guide/domain';
import { exampleFailures } from '../examples.ts';
import type { Failure, Rule, ValidationContext } from './rule.ts';

const sha256 = (s: string) => new Bun.CryptoHasher('sha256').update(s).digest('hex');

/** Page, guide and seam-edge citations, each with where it is written. */
function allCitations(ctx: ValidationContext): { where: string; citation: Citation }[] {
  return [
    ...ctx.citations.map((c) => ({ where: c.page, citation: c.citation })),
    ...ctx.guides.flatMap((g) => g.citations.map((citation) => ({ where: g.file, citation }))),
    ...ctx.seams.flatMap((s) => Object.values(s.dependencies ?? {}).map((dep) => ({ where: `seams/${s.id}/seam.yaml`, citation: dep.cite }))),
    ...ctx.seams.flatMap((s) => s.edges.filter((e) => e.at).map((e) => ({ where: `seams/${s.id}/seam.yaml`, citation: e.at! }))),
  ];
}

export const EverySymbolInOneSeam: Rule = {
  id: 'EverySymbolInOneSeam',
  async check(ctx) {
    const f: Failure[] = ctx.assignment.conflicts.map((c) => ({ rule: this.id, where: c.symbol, message: `claimed by seams ${c.seams.join(', ')}` }));
    // The runtime's own symbols are placed by the seams that list them; one may list each.
    const wordpress = new Set(ctx.inventory.symbols.map((s) => s.id));
    const listers = new Map<string, string[]>();
    for (const seam of ctx.seams) for (const id of seam.symbols) if (!wordpress.has(id)) listers.set(id, [...(listers.get(id) ?? []), seam.id]);
    for (const [id, seams] of listers) if (seams.length > 1) f.push({ rule: this.id, where: id, message: `claimed by seams ${[...seams].sort().join(', ')}` });
    if (ctx.config.requireAllAssigned) {
      for (const id of ctx.assignment.unassigned) f.push({ rule: this.id, where: id, message: 'in no seam' });
    }
    return f;
  },
};

export const CitationExists: Rule = {
  id: 'CitationExists',
  async check(ctx) {
    const f: Failure[] = [];
    for (const { where, citation: c } of allCitations(ctx)) {
      if (c.kind === 'example') {
        const declared = ctx.declaredExamples.find((e) => e.id === c.id);
        if (!declared) f.push({ rule: this.id, where, message: `${citationText(c)} does not exist in seams/*/examples` });
        // A guide backs no WordPress or SpeedySpec claim with an example; it only shows one, so it must exist.
        else if (where.startsWith('guides/')) continue;
        else if (where.startsWith('wordpress/')) {
          if (!declared.sides.includes('wordpress')) f.push({ rule: this.id, where, message: `${citationText(c)} does not run on WordPress, so it can't back a WordPress claim` });
        } else if (!declared.sides.includes('runtime')) f.push({ rule: this.id, where, message: `${citationText(c)} does not run on the runtime, so it can't back a SpeedySpec claim` });
        continue;
      }
      const ok =
        c.kind === 'scenario' ? await ctx.evidence.scenarioExists(c.area, c.name)
        : c.kind === 'break' ? await ctx.evidence.breakExists(c.area, c.scenario, c.step)
        : c.kind === 'test' ? await ctx.evidence.testExists(c.path)
        : (await ctx.evidence.sourceLines(c.base, c.file, c.from, c.to)) !== null;
      if (!ok) f.push({ rule: this.id, where, message: `${citationText(c)} does not exist at the pinned versions` });
    }
    return f;
  },
};

export const CitedLinesUnchanged: Rule = {
  id: 'CitedLinesUnchanged',
  async check(ctx) {
    const f: Failure[] = [];
    for (const { where, citation: c } of allCitations(ctx)) {
      if (c.kind !== 'source') continue;
      const lines = await ctx.evidence.sourceLines(c.base, c.file, c.from, c.to);
      if (lines === null) continue;
      const now = sha256(lines);
      if (c.hash === undefined) f.push({ rule: this.id, where, message: `${citationText(c)} has no hash; add hash="${now}"` });
      else if (c.hash !== now) f.push({ rule: this.id, where, message: `${citationText(c)} changed since it was cited; re-read it, then set hash="${now}"` });
    }
    return f;
  },
};

export const PortedSeamVerified: Rule = {
  id: 'PortedSeamVerified',
  async check(ctx) {
    const ported = new Set(ctx.seams.filter((s) => s.ported).map((s) => s.id));
    const verified = new Set(ctx.citations.filter((c) => c.citation.kind !== 'source').map((c) => c.page));
    return ctx.pages
      .filter((p) => p.section === 'speedyspec' && ported.has(p.seam) && !verified.has(p.page))
      .map(({ page }) => ({ rule: this.id, where: page, message: 'a ported seam\'s SpeedySpec page needs a scenario, break or test citation, not source alone' }));
  },
};

export const WordPressPagesCiteWordPress: Rule = {
  id: 'WordPressPagesCiteWordPress',
  async check(ctx) {
    return ctx.citations
      .filter((c) => c.section === 'wordpress' && c.citation.kind === 'source' && c.citation.base === 'ss')
      .map((c) => ({ rule: this.id, where: c.page, message: `${citationText(c.citation)}: WordPress pages cite WordPress's code only` }));
  },
};

export const VersionHasTag: Rule = {
  id: 'VersionHasTag',
  async check(ctx) {
    const wp = new Set(ctx.history.tags);
    const ss = new Set(ctx.runtimeTags);
    return ctx.versionsOnPages
      .filter((v) => !(v.base === 'wp' ? wp : ss).has(v.version))
      .map((v) => ({
        rule: this.id,
        where: v.page,
        message: v.base === 'wp' ? `WordPress ${v.version} has no release tag` : `SpeedySpec ${v.version} has no speedyspec-php-runtime-v${v.version} tag`,
      }));
  },
};

export const ExampleHasRun: Rule = {
  id: 'ExampleHasRun',
  async check(ctx) {
    return exampleFailures(ctx.examples, ctx.declaredExamples).map((f) => ({ rule: this.id, ...f }));
  },
};

export const PortedSeamCovered: Rule = {
  id: 'PortedSeamCovered',
  async check(ctx) {
    if (!ctx.config.requirePortedCoverage) return [];
    const has = (section: 'wordpress' | 'speedyspec', id: string) => ctx.pages.some((p) => p.section === section && p.symbol === id);
    const f: Failure[] = [];
    for (const seam of ctx.seams.filter((s) => s.ported)) {
      const members = Object.entries(ctx.assignment.seamOf)
        .filter(([id, s]) => s === seam.id && !id.startsWith('method:'))
        .map(([id]) => id)
        .sort();
      for (const id of members) {
        const missing = [!has('wordpress', id) && 'WordPress', !has('speedyspec', id) && 'SpeedySpec'].filter(Boolean);
        if (missing.length > 0) f.push({ rule: this.id, where: id, message: `the ${seam.id} seam is ported: needs a WordPress page and a SpeedySpec page (missing: ${missing.join(', ')})` });
      }
    }
    return f;
  },
};

/**
 * A seam listed in `requireWordPressCoverage` is documented on its WordPress side: every member but a method has a
 * WordPress page, and every function has an example that ran and passed on WordPress.
 */
export const DocumentedSeamCovered: Rule = {
  id: 'DocumentedSeamCovered',
  async check(ctx) {
    const seams = ctx.config.requireWordPressCoverage ?? [];
    const f: Failure[] = [];
    const passed = new Set((ctx.examples?.results ?? []).filter((r) => r.side === 'wordpress' && r.passed).map((r) => r.id.split('/').slice(0, 2).join('/')));
    for (const seam of seams) {
      const members = Object.entries(ctx.assignment.seamOf)
        .filter(([id, s]) => s === seam && !id.startsWith('method:'))
        .map(([id]) => id)
        .sort();
      for (const id of members) {
        const fail = (need: string) => f.push({ rule: this.id, where: id, message: `the ${seam} seam is documented: ${id} needs ${need}` });
        if (!ctx.pages.some((p) => p.section === 'wordpress' && p.symbol === id)) fail('a WordPress page');
        // A function's examples are in the folder named after it.
        else if (id.startsWith('function:') && !passed.has(`${seam}/${id.slice('function:'.length)}`)) fail('an example run on WordPress');
      }
    }
    return f;
  },
};

export const CitesItsScenario: Rule = {
  id: 'CitesItsScenario',
  async check(ctx) {
    const f: Failure[] = [];
    for (const page of ctx.pages) {
      if (!page.symbol) continue;
      const seam = ctx.seams.find((s) => s.id === page.seam);
      // SpeedySpec pages: a ported seam's must cite its scenarios. WordPress pages: only one that cites scenarios at all.
      const index = seam && (page.section === 'wordpress' || seam.ported) ? ctx.evidenceIndex[seam.id] : undefined;
      if (!index) continue;
      const cited = ctx.citations.filter((c) => c.page === page.page).map((c) => c.citation);
      if (page.section === 'wordpress' && !cited.some((c) => c.kind === 'scenario' || c.kind === 'break')) continue;
      const id = page.symbol;
      const relevant = Object.entries(index).filter(([sym]) => sym === id || (id.startsWith('class:') && sym.startsWith(`method:${id.slice('class:'.length)}::`)));
      // A symbol no scenario exercises (SpeedySpec's own API) is verified by tests instead.
      if (relevant.length === 0) continue;
      const scenarios = new Set(relevant.flatMap(([, e]) => e.scenarios));
      const breaks = new Set(relevant.flatMap(([, e]) => e.breaks.map((b) => b.scenario)));
      const ok = cited.some((c) => (c.kind === 'scenario' && scenarios.has(c.name)) || (c.kind === 'break' && breaks.has(c.scenario)));
      if (!ok) f.push({ rule: this.id, where: page.page, message: `cites no scenario that exercises ${id}; candidates: ${[...scenarios].sort().slice(0, 3).join(', ')}` });
    }
    return f;
  },
};

/**
 * A method the runtime adds to a WordPress class in a seam (WP_Hook::speedyspec_wrap) is listed by that seam, so its
 * page sits with its class instead of on the runtime page.
 */
export const RuntimeMembersListed: Rule = {
  id: 'RuntimeMembersListed',
  async check(ctx) {
    if (ctx.runtimeIds === null) return [];
    const wordpress = new Set(ctx.inventory.symbols.map((s) => s.id));
    const listed = new Map<string, string>();
    for (const seam of ctx.seams) for (const id of seam.symbols) listed.set(id, seam.id);
    const f: Failure[] = [];
    for (const id of ctx.runtimeIds) {
      if (!id.startsWith('method:') || wordpress.has(id) || listed.has(id)) continue;
      const cls = `class:${id.slice('method:'.length, id.lastIndexOf('::'))}`;
      const seam = ctx.assignment.seamOf[cls] ?? listed.get(cls);
      if (seam !== undefined) f.push({ rule: this.id, where: `seams/${seam}/seam.yaml`, message: `the runtime adds ${id} to ${cls}; list it in the seam` });
    }
    return f;
  },
};

/**
 * A ported seam records the state of every symbol it depends on in another seam (still WordPress's PHP, behind a
 * port, or in Rust), and records no state for a symbol it doesn't depend on. Unported seams may record states.
 */
export const DependencyStateRecorded: Rule = {
  id: 'DependencyStateRecorded',
  async check(ctx) {
    const f: Failure[] = [];
    for (const seam of ctx.seams) {
      const targets = new Set(ctx.crossSeam.filter((e) => e.fromSeam === seam.id).map((e) => e.to));
      const recorded = seam.dependencies ?? {};
      const where = `seams/${seam.id}/seam.yaml`;
      if (seam.ported) for (const t of [...targets].sort()) if (!(t in recorded)) f.push({ rule: this.id, where, message: `${seam.id}: ${t} has no recorded state` });
      for (const t of Object.keys(recorded).sort()) if (!targets.has(t)) f.push({ rule: this.id, where, message: `${seam.id}: ${t} is not a dependency` });
    }
    return f;
  },
};

/** A seam's exact file names (no glob characters) name files WordPress has, so a typo or a removed file can't place
 * nothing in silence. */
export const SeamFilesExist: Rule = {
  id: 'SeamFilesExist',
  async check(ctx) {
    const files = new Set(ctx.inventory.symbols.map((s) => s.file));
    const f: Failure[] = [];
    for (const seam of ctx.seams) {
      for (const file of seam.files) {
        if (/[*?[{]/.test(file) || files.has(file)) continue;
        f.push({ rule: this.id, where: `seams/${seam.id}/seam.yaml`, message: `lists ${file}, which WordPress doesn't have` });
      }
    }
    return f;
  },
};

export const SeamSymbolsExist: Rule = {
  id: 'SeamSymbolsExist',
  async check(ctx) {
    const wordpress = new Set(ctx.inventory.symbols.map((s) => s.id));
    const runtime = ctx.runtimeIds ? new Set(ctx.runtimeIds) : null;
    const f: Failure[] = [];
    for (const seam of ctx.seams) {
      for (const id of seam.symbols) {
        if (wordpress.has(id)) continue;
        // Without the runtime's inventory, SpeedySpec's own ids can't be checked.
        if (runtime === null ? id.slice(id.indexOf(':') + 1).startsWith('SpeedySpec\\') : runtime.has(id)) continue;
        f.push({ rule: this.id, where: `seams/${seam.id}/seam.yaml`, message: `lists ${id}, which neither WordPress nor the runtime has` });
      }
    }
    return f;
  },
};

/** The PHP calls that add a callback: `add_filter(`, `add_action(`, `add_shortcode(` and `WP_Hook`'s `->add_filter(`. */
const ADDS_CALLBACK = /(?:\badd_(?:filter|action|shortcode)|->add_filter)\s*\(/g;
/** A callback argument nothing can name again: a closure, an arrow function or a method of a new object. */
const UNREMOVABLE = /^(?:static\s+)?(?:function\b|fn\b)|^array\s*\(\s*new\b|^\[\s*new\b/;
/** Marks an example whose point is an unremovable callback, such as one showing why not to add one. */
const DELIBERATE = '// guide: closure on purpose';

/** The second argument of the call whose opening parenthesis ends at `from`, or null when it has none. */
function secondArgument(code: string, from: number): string | null {
  let depth = 0;
  let quote: string | null = null;
  let start = -1;
  for (let i = from; i < code.length; i++) {
    const ch = code[i]!;
    if (quote) {
      if (ch === '\\') i++;
      else if (ch === quote) quote = null;
      continue;
    }
    if (ch === "'" || ch === '"') quote = ch;
    else if (ch === '(' || ch === '[') depth++;
    else if (ch === ')' || ch === ']') {
      if (depth === 0) return start < 0 ? null : code.slice(start, i).trim();
      depth--;
    } else if (ch === ',' && depth === 0) {
      if (start >= 0) return code.slice(start, i).trim();
      start = i + 1;
    }
  }
  return null;
}

/**
 * Every example adds hook and shortcode callbacks as a named function or a method of a kept object. A hook callback
 *  that is a closure, an arrow function or `array( new Foo(), 'bar' )` can never be removed, and readers copy what
 *  examples show, so shortcodes follow the same rule.
 */
export const ExampleCallbackRemovable: Rule = {
  id: 'ExampleCallbackRemovable',
  async check(ctx) {
    const f: Failure[] = [];
    for (const { id, code } of ctx.declaredExamples) {
      if (code === undefined || code.includes(DELIBERATE)) continue;
      const bad = [...code.matchAll(ADDS_CALLBACK)].some((m) => {
        const arg = secondArgument(code, m.index! + m[0].length);
        return arg !== null && UNREMOVABLE.test(arg);
      });
      if (bad) f.push({ rule: this.id, where: id, message: 'adds a closure, arrow function or new object as a hook or shortcode callback; add a named function or a kept object' });
    }
    return f;
  },
};

/** Every example a guide embeds is an example file. Whether it ran and passed is ExampleHasRun's to say. */
export const GuideExampleExists: Rule = {
  id: 'GuideExampleExists',
  async check(ctx) {
    const known = new Set(ctx.declaredExamples.map((e) => e.id));
    return ctx.guides.flatMap((g) => g.examples.filter((id) => !known.has(id)).map((id) => ({ rule: this.id, where: g.file, message: `embeds ${id}, which is no example` })));
  },
};

/** Every symbol a guide links is a WordPress symbol, or a SpeedySpec one when the runtime's are known. */
export const GuideSymbolResolves: Rule = {
  id: 'GuideSymbolResolves',
  async check(ctx) {
    const known = new Set([...ctx.inventory.symbols.map((s) => s.id), ...(ctx.runtimeIds ?? [])]);
    return ctx.guides.flatMap((g) => g.symbols.filter((id) => !known.has(id)).map((id) => ({ rule: this.id, where: g.file, message: `links ${id}, which is no symbol` })));
  },
};

/** A topic guide explains a seam that exists; the guides' own example seam is no seam to explain. */
export const GuideTopicSeamExists: Rule = {
  id: 'GuideTopicSeamExists',
  async check(ctx) {
    const seams = new Set(ctx.seams.map((s) => s.id).filter((id) => id !== 'guides'));
    return ctx.guides
      .filter((g) => g.kind === 'topic' && !seams.has(g.seam ?? ''))
      .map((g) => ({ rule: this.id, where: g.file, message: `is a topic guide for ${g.seam}, which is no seam` }));
  },
};

/**
 * A guide has a title and a summary; a numbered track's files have an nn- prefix, and no two in a track share a
 * number or a slug (they would share a page).
 */
export const GuideFrontAndOrder: Rule = {
  id: 'GuideFrontAndOrder',
  async check(ctx) {
    const track = (g: Guide) => `${g.kind}/${g.part ?? ''}`;
    const f: Failure[] = [];
    for (const g of ctx.guides) {
      if (g.title === '' || g.summary === '') f.push({ rule: this.id, where: g.file, message: 'needs a title and a summary' });
      if (g.kind === 'topic') continue;
      for (const other of ctx.guides) {
        if (other !== g && track(other) === track(g) && other.slug === g.slug) f.push({ rule: this.id, where: g.file, message: `shares slug ${g.slug} with ${other.file}` });
      }
      if (g.order === undefined) {
        f.push({ rule: this.id, where: g.file, message: 'needs an nn- number prefix' });
        continue;
      }
      for (const other of ctx.guides) {
        if (other !== g && track(other) === track(g) && other.order === g.order) f.push({ rule: this.id, where: g.file, message: `shares number ${g.order} with ${other.file}` });
      }
    }
    return f;
  },
};
