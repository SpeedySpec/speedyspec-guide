/** `generated/conversion.json`: which WordPress symbols SpeedySpec has converted to Rust. */
import type { GuideSymbol } from '@speedyspec-guide/domain';

/** Rust the runtime registers, or Rust in a speedyspec-server port the runtime doesn't boot yet. PHP has no entry. */
export type ConversionState = 'runtime' | 'ported';

export interface ConversionFile {
  states: Record<string, ConversionState>;
}

/** The kinds a state is given: hooks and globals follow from the functions that fire or hold them. */
const KINDS = new Set(['function', 'class', 'method', 'constant']);

/**
 * The state of each WordPress symbol SpeedySpec has converted. `runtimeIds` is what the runtime registers (its
 * Reflection); `ported` is what the server's PHP facades declare. The runtime beats a port.
 */
export function conversionStates(wordpress: GuideSymbol[], runtimeIds: Set<string>, ported: Set<string>): Record<string, ConversionState> {
  const states: Record<string, ConversionState> = {};
  for (const s of wordpress) {
    if (!KINDS.has(s.kind)) continue;
    if (runtimeIds.has(s.id)) states[s.id] = 'runtime';
    else if (ported.has(s.id)) states[s.id] = 'ported';
  }
  return states;
}
