/** The porting and architecture pages of each seam. */
import type { GuideData } from './data.ts';

export function seamPage(seamId: string, kind: 'porting' | 'architecture', d: GuideData) {
  return d.content.find((c) => c.section === 'speedyspec' && c.seam === seamId && c.kind === kind) ?? null;
}
