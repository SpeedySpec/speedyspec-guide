import { beforeAll, describe, expect, test } from 'bun:test';
import { existsSync } from 'node:fs';
import { join } from 'node:path';
import { fixtureSite } from './fixture-build.ts';

let dist = '';
beforeAll(() => {
  dist = fixtureSite();
}, 240_000);

describe('internal links', () => {
  test('every link inside the site goes to a page that was built', async () => {
    const broken: string[] = [];
    for await (const file of new Bun.Glob('**/*.html').scan({ cwd: dist })) {
      if (file.startsWith('component-tests/')) continue;
      const hrefs: string[] = [];
      new HTMLRewriter().on('a[href]', { element: (el) => { hrefs.push(el.getAttribute('href')!); } }).transform(await Bun.file(join(dist, file)).text());
      for (const href of hrefs) {
        if (!href.startsWith('/')) continue;
        const path = decodeURIComponent(href.split('#')[0]!);
        const target = path.endsWith('/') ? join(dist, path, 'index.html') : join(dist, path);
        if (!existsSync(target)) broken.push(`${file} → ${href}`);
      }
    }
    expect(broken).toEqual([]);
  });
});
