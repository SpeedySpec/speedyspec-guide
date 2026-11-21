import { describe, expect, test } from 'bun:test';
import { loadOrder, loadPositions } from '../src/load-order.ts';

describe('load order', () => {
  test('reads_requires_in_order', () => {
    const settings = "require ABSPATH . WPINC . '/version.php';\nrequire_once ABSPATH . WPINC . '/plugin.php';\nrequire ABSPATH . 'wp-admin/includes/x.php';\nrequire( ABSPATH . WPINC . '/a.php' );";
    expect(loadOrder(settings)).toEqual(['wp-includes/version.php', 'wp-includes/plugin.php', 'wp-admin/includes/x.php', 'wp-includes/a.php']);
  });
  test('a file required twice keeps its first place', () => {
    expect(loadOrder("require ABSPATH . WPINC . '/a.php';\nrequire ABSPATH . WPINC . '/b.php';\nrequire_once ABSPATH . WPINC . '/a.php';")).toEqual(['wp-includes/a.php', 'wp-includes/b.php']);
  });
  test('unrequired_files_follow_in_path_order', () => {
    const pos = loadPositions(['wp-includes/b.php'], ['wp-login.php', 'wp-admin/a.php', 'wp-includes/b.php']);
    expect(pos.get('wp-includes/b.php')).toBe(0);
    const admin = pos.get('wp-admin/a.php')!;
    const login = pos.get('wp-login.php')!;
    expect(admin).toBeGreaterThanOrEqual(1);
    expect(login).toBeGreaterThanOrEqual(1);
    expect(admin).toBeLessThan(login);
  });
});
