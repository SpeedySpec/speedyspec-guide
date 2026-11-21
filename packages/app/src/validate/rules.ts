import { type Citation, citationText } from '@speedyspec-guide/domain';
import { exampleFailures } from '../examples.ts';
import type { Failure, Rule, ValidationContext } from './rule.ts';

const sha256 = (s: string) => new Bun.CryptoHasher('sha256').update(s).digest('hex');

/** Page citations and seam-edge citations, each with where it is written. */
function allCitations(ctx: ValidationContext): { where: string; citation: Citation }[] {
  return [
    ...ctx.citations.map((c) => ({ where: c.page, citation: c.citation })),
    ...ctx.seams.flatMap((s) => s.edges.filter((e) => e.at).map((e) => ({ where: `seams/${s.id}/seam.yaml`, citation: e.at! }))),
  ];
}

export const EverySymbolInOneSeam: Rule = {
  id: 'EverySymbolInOneSeam',
  async check(ctx) {
    const f: Failure[] = ctx.assignment.conflicts.map((c) => ({ rule: this.id, where: c.symbol, message: `claimed by seams ${c.seams.join(', ')}` }));
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

export const CitesItsScenario: Rule = {
  id: 'CitesItsScenario',
  async check(ctx) {
    const f: Failure[] = [];
    for (const page of ctx.pages) {
      if (page.section !== 'speedyspec' || !page.symbol) continue;
      const seam = ctx.seams.find((s) => s.id === page.seam);
      const index = seam?.ported ? ctx.evidenceIndex[seam.id] : undefined;
      if (!index) continue;
      const id = page.symbol;
      const relevant = Object.entries(index).filter(([sym]) => sym === id || (id.startsWith('class:') && sym.startsWith(`method:${id.slice('class:'.length)}::`)));
      // A symbol no scenario exercises (SpeedySpec's own API) is verified by tests instead.
      if (relevant.length === 0) continue;
      const scenarios = new Set(relevant.flatMap(([, e]) => e.scenarios));
      const breaks = new Set(relevant.flatMap(([, e]) => e.breaks.map((b) => b.scenario)));
      const cited = ctx.citations.filter((c) => c.page === page.page).map((c) => c.citation);
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
      const seam = ctx.assignment.seamOf[cls];
      if (seam !== undefined) f.push({ rule: this.id, where: `seams/${seam}/seam.yaml`, message: `the runtime adds ${id} to ${cls}; list it in the seam` });
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
