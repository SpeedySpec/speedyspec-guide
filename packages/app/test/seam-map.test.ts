/**
 * The real seam map against the real inventories. Needs `bun run guide extract fork` first; skipped without them.
 */
import { describe, expect, test } from 'bun:test';
import { existsSync, readFileSync } from 'node:fs';
import { join } from 'node:path';
import type { Inventory } from '@speedyspec-guide/domain';
import { SeamFiles } from '../../adapter-seam-files/src/index.ts';
import { assign } from '../src/assign.ts';
import { loadOrder } from '../src/load-order.ts';

const root = join(import.meta.dir, '..', '..', '..');
const gen = (name: string) => join(root, 'generated', `${name}.json`);
const ready = existsSync(gen('inventory-wp')) && existsSync(gen('inventory-ss'));
const pin = JSON.parse(readFileSync(join(root, 'sources.json'), 'utf8')) as { wordpress: { commit: string } };
const settings = join(root, '.cache', `wordpress-${pin.wordpress.commit.slice(0, 12)}`, 'wp-settings.php');

describe.skipIf(!ready || !existsSync(settings))('the seam map (run `bun run guide extract fork` first)', () => {
  test('every_wordpress_symbol_is_in_one_seam', async () => {
    const wp = JSON.parse(readFileSync(gen('inventory-wp'), 'utf8')) as Inventory;
    const ss = JSON.parse(readFileSync(gen('inventory-ss'), 'utf8')) as Inventory;
    const a = assign(wp, await new SeamFiles(join(root, 'seams')).all(), ss, loadOrder(readFileSync(settings, 'utf8')));
    expect(a.conflicts).toEqual([]);
    expect(a.unassigned).toEqual([]);
  });

  test('admin_and_bundled_are_outside_the_fork', async () => {
    const seams = await new SeamFiles(join(root, 'seams')).all();
    expect(seams.filter((s) => s.inFork === false).map((s) => s.id).sort()).toEqual(['admin', 'bundled']);
  });
});
