<?php

declare(strict_types=1);

/**
 * The shared basic setup, plus a site and a logged-in user for the admin bar's menus.
 *
 *  With no database, the site's options come from filters: it is `http://example.org`, titled `Guide`, without avatars. A front-end
 *  request is assumed. `guide_log_in()` makes user 1, `admin`, the current user, with the capabilities it is given.
 */

require __DIR__ . '/../basic-setup.php';

foreach ([
    'home' => 'http://example.org',
    'siteurl' => 'http://example.org',
    'blogname' => 'Guide',
    'permalink_structure' => '',
    'show_avatars' => '',
    'site_icon' => '0',
    'avatar_rating' => 'G',
    'avatar_default' => 'mystery',
    'link_manager_enabled' => 0,
] as $guide_name => $guide_value)
{
    add_filter("pre_option_{$guide_name}", static fn () => $guide_value);
}
foreach (['OBJECT', 'OBJECT_K', 'ARRAY_A', 'ARRAY_N'] as $guide_name)
{
    defined($guide_name) || define($guide_name, $guide_name);
}
defined('COOKIEHASH') || define('COOKIEHASH', md5('http://example.org'));
// default-constants.php's cookie constants, and fixed keys and salts, as wp-config.php sets them.
foreach ([
    'USER_COOKIE' => 'wordpressuser_' . COOKIEHASH,
    'PASS_COOKIE' => 'wordpresspass_' . COOKIEHASH,
    'AUTH_COOKIE' => 'wordpress_' . COOKIEHASH,
    'SECURE_AUTH_COOKIE' => 'wordpress_sec_' . COOKIEHASH,
    'LOGGED_IN_COOKIE' => 'wordpress_logged_in_' . COOKIEHASH,
    'COOKIEPATH' => '/',
    'SITECOOKIEPATH' => '/',
    'ADMIN_COOKIE_PATH' => '/wp-admin',
    'PLUGINS_COOKIE_PATH' => '/wp-content/plugins',
    'COOKIE_DOMAIN' => false,
    'AUTH_KEY' => 'guide-auth-key',
    'AUTH_SALT' => 'guide-auth-salt',
    'NONCE_KEY' => 'guide-nonce-key',
    'NONCE_SALT' => 'guide-nonce-salt',
    'LOGGED_IN_KEY' => 'guide-logged-in-key',
    'LOGGED_IN_SALT' => 'guide-logged-in-salt',
    'SECURE_AUTH_KEY' => 'guide-secure-auth-key',
    'SECURE_AUTH_SALT' => 'guide-secure-auth-salt',
] as $guide_name => $guide_value)
{
    defined($guide_name) || define($guide_name, $guide_value);
}
$_SERVER['HTTP_HOST'] = 'example.org';
$_SERVER['REQUEST_URI'] = '/hello/';
// Any other option would be read from the database; say which instead of failing on a missing $wpdb.
add_filter('pre_option', static function ($pre, $name) { if (false === $pre) { throw new RuntimeException('unanswered option ' . $name); } return $pre; }, 99, 2);
// default-filters.php registers the icons on init; the menus' items show them.
_wp_register_default_icon_collections();
_wp_register_default_icons();
unset($guide_name, $guide_value);

/**
 * Stands in for `$wpdb` where WordPress only needs the table prefix, as for the users' capability keys.
 *
 *  It runs no query: code that would read the database fails on a missing method, naming it.
 */
final class Guide_Prefix_Only_Wpdb
{
    public string $prefix = 'wp_';
    public string $base_prefix = 'wp_';
    public string $users = 'wp_users';
    public string $usermeta = 'wp_usermeta';

    public function get_blog_prefix($blog_id = null): string
    {
        return 'wp_';
    }
}
$GLOBALS['wpdb'] = new Guide_Prefix_Only_Wpdb();

/**
 * Logs in `admin` (user 1) with a `guide` role holding the given capabilities.
 *
 *  The user's row, capabilities and the role are put where WordPress caches them after reading the database, so
 *  `wp_set_current_user()` builds a real `WP_User` without a query.
 */
function guide_log_in(array $caps = []): WP_User
{
    $GLOBALS['wp_user_roles'] = ['guide' => ['name' => 'Guide', 'capabilities' => $caps]];
    unset($GLOBALS['wp_roles']);
    wp_cache_add(1, (object) [
        'ID' => '1',
        'user_login' => 'admin',
        'user_nicename' => 'admin',
        'user_email' => 'admin@example.org',
        'user_url' => '',
        'user_registered' => '2026-01-01 00:00:00',
        'display_name' => 'Ada',
    ], 'users');
    wp_cache_add('admin', 1, 'userlogins');
    wp_cache_add(1, ['wp_capabilities' => [serialize(['guide' => true])], 'wp_user_level' => ['0']], 'user_meta');
    return wp_set_current_user(1);
}

/** Lists an admin bar's nodes as `parent > id href`, without nonces, which change with time. */
function guide_nodes(WP_Admin_Bar $bar): array
{
    $out = [];
    foreach ($bar->get_nodes() ?? [] as $node)
    {
        $href = is_string($node->href) ? preg_replace('/([?&](amp;)?)_wpnonce=[0-9a-f]+/', '$1_wpnonce=…', $node->href) : '';
        $out[] = trim(($node->parent ?: '') . ' > ' . $node->id . ' ' . $href);
    }
    return $out;
}
