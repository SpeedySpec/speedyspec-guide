/** How SpeedySpec's `packages/` fork relates to WordPress for one symbol. */
export type ForkVerdict = 'same' | 'modified' | 'removed' | 'added';

/** A symbol's verdict on SpeedySpec. */
export type Verdict = 'works-as-wordpress' | 'works-with-differences' | 'breaks' | 'new-in-speedyspec';
