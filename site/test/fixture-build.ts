import { join } from 'node:path';
import { buildSite } from './helpers.ts';

const fixtures = join(import.meta.dir, 'fixtures');

/** The site built from the test fixtures (shared by the section tests). */
export function fixtureSite(): string {
  const build = buildSite({
    GUIDE_DATA_DIR: join(fixtures, 'generated'), GUIDE_SOURCES: join(fixtures, 'sources.json'),
    GUIDE_SEAMS_DIR: join(fixtures, 'seams'),
    GUIDE_CONTENT_DIR: join(fixtures, 'content'),
    GUIDE_SOURCES: join(fixtures, '..', '..', '..', 'sources.json'),
  });
  if (build.exitCode !== 0) throw new Error(build.output);
  return build.dist;
}
