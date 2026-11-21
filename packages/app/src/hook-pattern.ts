/** A regular expression matching every literal hook name a `{$…}` template can produce. */
export function hookPattern(template: string): RegExp {
  const parts = template.split(/\{\$[^}]*\}/);
  return new RegExp(`^${parts.map((p) => p.replace(/[.*+?^${}()|[\]\\]/g, '\\$&')).join('.+')}$`);
}
