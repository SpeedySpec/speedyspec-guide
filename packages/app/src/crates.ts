/** `generated/crates.json`: the server's crates and which other workspace crates each depends on. */
export interface CratesFile {
  crates: { name: string; dependencies: string[] }[];
}

/** Reads the crates' Cargo.toml files. Only `[dependencies]` on other crates in the same set count. */
export function readCrates(files: { path: string; text: string }[]): CratesFile {
  const parsed = files.map((f) => {
    const toml = Bun.TOML.parse(f.text) as { package?: { name?: string }; dependencies?: Record<string, unknown> };
    const name = toml.package?.name;
    if (!name) throw new Error(`${f.path}: no [package] name`);
    return { name, deps: Object.keys(toml.dependencies ?? {}) };
  });
  const names = new Set(parsed.map((p) => p.name));
  return {
    crates: parsed
      .map((p) => ({ name: p.name, dependencies: p.deps.filter((d) => names.has(d)).sort() }))
      .sort((a, b) => a.name.localeCompare(b.name)),
  };
}
