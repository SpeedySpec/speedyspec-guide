import { describe, expect, test } from 'bun:test';
import { readCrates } from '../src/crates.ts';

describe('readCrates', () => {
  test('keeps only dependencies on other workspace crates, and ignores dev-dependencies', () => {
    const files = [
      { path: 'crates/speedyspec-wp-hooks-php/Cargo.toml', text: '[package]\nname = "speedyspec-wp-hooks-php"\nversion.workspace = true\n\n[dependencies]\nserde = "1"\nspeedyspec-wp-hooks = { path = "../speedyspec-wp-hooks" }\nspeedyspec-php = { path = "../speedyspec-php" }\n\n[dev-dependencies]\nspeedyspec-test = { path = "../speedyspec-test" }\n' },
      { path: 'crates/speedyspec-wp-hooks/Cargo.toml', text: '[package]\nname = "speedyspec-wp-hooks"\n\n[dependencies]\nthiserror = "2"\n' },
      { path: 'crates/speedyspec-php/Cargo.toml', text: '[package]\nname = "speedyspec-php"\n' },
      { path: 'crates/speedyspec-test/Cargo.toml', text: '[package]\nname = "speedyspec-test"\n' },
    ];
    expect(readCrates(files)).toEqual({ crates: [
      { name: 'speedyspec-php', dependencies: [] },
      { name: 'speedyspec-test', dependencies: [] },
      { name: 'speedyspec-wp-hooks', dependencies: [] },
      { name: 'speedyspec-wp-hooks-php', dependencies: ['speedyspec-php', 'speedyspec-wp-hooks'] },
    ] });
  });
});
