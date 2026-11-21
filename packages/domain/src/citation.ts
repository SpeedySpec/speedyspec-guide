/** Where a claim's evidence lives. Value Object. */
export type Citation =
  | { kind: 'scenario'; area: string; name: string }
  | { kind: 'break'; area: string; scenario: string; step?: number }
  | { kind: 'test'; path: string }
  /** One of the guide's own examples, run in CI (on the runtime, when it backs a SpeedySpec claim). */
  | { kind: 'example'; id: string }
  | { kind: 'source'; base: 'wp' | 'ss'; file: string; from: number; to: number; hash?: string };

/** Parses the attributes of an `<Ev …/>` citation, or a seam edge's `at`. */
export function parseCitation(attrs: Record<string, string>): Citation {
  const area = attrs.area ?? 'hooks';
  if (attrs.scenario !== undefined) return { kind: 'scenario', area, name: attrs.scenario };
  if (attrs.break !== undefined) {
    const c: Citation = { kind: 'break', area, scenario: attrs.break };
    if (attrs.step !== undefined) {
      const step = Number(attrs.step);
      if (!Number.isInteger(step) || step < 0) throw new Error(`bad break step: ${attrs.step}`);
      c.step = step;
    }
    return c;
  }
  if (attrs.test !== undefined) return { kind: 'test', path: attrs.test };
  if (attrs.example !== undefined) return { kind: 'example', id: attrs.example };
  if (attrs.source !== undefined) {
    const m = /^(wp|ss):([^#]+)#L(\d+)(?:-L(\d+))?$/.exec(attrs.source);
    if (!m) throw new Error(`bad source citation: ${attrs.source}`);
    const from = Number(m[3]);
    const to = m[4] === undefined ? from : Number(m[4]);
    if (to < from) throw new Error(`bad source range: ${attrs.source}`);
    const c: Citation = { kind: 'source', base: m[1] as 'wp' | 'ss', file: m[2]!, from, to };
    if (attrs.hash !== undefined) c.hash = attrs.hash;
    return c;
  }
  throw new Error(`citation names no evidence: ${JSON.stringify(attrs)}`);
}

/** A short, stable text form of a citation, for messages. */
export function citationText(c: Citation): string {
  switch (c.kind) {
    case 'scenario': return `scenario ${c.area}/${c.name}`;
    case 'break': return `break ${c.area}/${c.scenario}${c.step === undefined ? '' : `#${c.step}`}`;
    case 'test': return `test ${c.path}`;
    case 'example': return `example ${c.id}`;
    case 'source': return `${c.base}:${c.file}#L${c.from}${c.to === c.from ? '' : `-L${c.to}`}`;
  }
}
