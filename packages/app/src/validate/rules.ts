import { type Citation, citationText } from '@speedyspec-guide/domain';
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
    const tags = new Set(ctx.history.tags);
    return ctx.versionsOnPages
      .filter((v) => v.base === 'wp' && !tags.has(v.version))
      .map((v) => ({ rule: this.id, where: v.page, message: `WordPress ${v.version} has no release tag` }));
  },
};
