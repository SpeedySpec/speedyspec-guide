import { describe, expect, test } from 'bun:test';
import { join } from 'node:path';
import { SeamFiles } from '../../adapter-seam-files/src/index.ts';
import { ExampleFiles } from '../src/index.ts';

const dir = join(import.meta.dir, '..', '..', '..', 'tests', 'fixtures', 'examples-seams');

async function read() {
  return new ExampleFiles(dir, await new SeamFiles(dir).all()).all();
}

describe('ExampleFiles', () => {
  test('reads an example with its id, file, sides and expected outcome', async () => {
    const { examples } = await read();
    expect(examples).toEqual([{
      id: 'hooks/add_filter/a', seam: 'hooks', symbol: 'add_filter', name: 'a',
      file: join(dir, 'hooks/examples/add_filter/a.php'),
      sides: ['wordpress', 'runtime'],
      expect: { output: '', return: '20', error: null },
    }]);
  });

  test('reports every problem once, with the file it concerns', async () => {
    const { problems } = await read();
    const byFile = (f: string) => problems.filter((p) => p.where.endsWith(f)).map((p) => p.message);
    expect(byFile('orphan.php')).toEqual(['has no orphan.expect.json']);
    expect(byFile('lonely.expect.json')).toEqual(['has no lonely.php']);
    expect(byFile('incomplete.expect.json')).toEqual(['needs "error" (a string, or null)']);
    expect(byFile('elsewhere.expect.json')).toEqual(['side "moon" is not wordpress or runtime']);
    expect(byFile('get_option/b.expect.json')).toEqual(['runs on runtime, but the options seam is not ported']);
    expect(problems).toHaveLength(5);
  });

  test('SeamFiles reads the WordPress files to load, defaulting to none', async () => {
    const seams = await new SeamFiles(dir).all();
    expect(seams.find((s) => s.id === 'hooks')?.wordpress).toEqual(['wp-includes/plugin.php']);
    expect(seams.find((s) => s.id === 'options')?.wordpress).toEqual([]);
  });
});
