<?php

declare(strict_types=1);

/**
 * Boots WordPress for an example as a request to a freshly installed site, for seams whose functions need all of
 *  WordPress loaded the way `wp-settings.php` loads it.
 *
 *  It recreates WordPress's tables (`wordpress-schema.php`) with the `guide_` prefix in the MySQL database in
 *  `GUIDE_MYSQL_URL`, stores the options a site needs to load, and requires `wp-settings.php`, which loads WordPress,
 *  its default filters and `init`. Afterwards it does what an install would: the default options and roles, the
 *  Uncategorized category, and an administrator, `admin`, user 1, logged in. Cron is off, and every HTTP request an
 *  example doesn't answer itself (on `pre_http_request`) fails with `http_request_blocked`, so nothing leaves the
 *  machine: the site's own host, which `WP_HTTP_BLOCK_EXTERNAL` would let through, is a real domain. The seam's
 *  `seam.yaml` loads only `wp-includes/version.php` and sets
 *  `mysql: true`.
 *
 *  Options: siteurl and home `http://example.org`, blogname `Guide`, admin_email `admin@example.org`, plain
 *  permalinks, and the theme `guide`, which isn't installed, so no theme code runs.
 *
 *  With `GUIDE_MULTISITE`, the site is the main site of a subdirectory network instead: network 1 at `example.org/`,
 *  named `Guide Network`, with the network's default options and `admin` as its super admin.
 */

$guide_url = getenv('GUIDE_MYSQL_URL');
if (!$guide_url)
{
    throw new RuntimeException('this seam\'s examples need a MySQL database: set GUIDE_MYSQL_URL');
}
$guide_db = parse_url($guide_url);
foreach ([
    'DB_NAME' => ltrim($guide_db['path'] ?? '', '/'),
    'DB_USER' => urldecode($guide_db['user'] ?? ''),
    'DB_PASSWORD' => urldecode($guide_db['pass'] ?? ''),
    'DB_HOST' => ($guide_db['host'] ?? 'localhost') . (isset($guide_db['port']) ? ':' . $guide_db['port'] : ''),
    'DB_CHARSET' => 'utf8mb4',
    'DB_COLLATE' => '',
    'WP_DEBUG' => false,
    'WP_DEBUG_DISPLAY' => false,
    'DISABLE_WP_CRON' => true,
    'WP_HTTP_BLOCK_EXTERNAL' => true,
    'AUTH_KEY' => 'guide auth key',
    'SECURE_AUTH_KEY' => 'guide secure auth key',
    'LOGGED_IN_KEY' => 'guide logged in key',
    'NONCE_KEY' => 'guide nonce key',
    'AUTH_SALT' => 'guide auth salt',
    'SECURE_AUTH_SALT' => 'guide secure auth salt',
    'LOGGED_IN_SALT' => 'guide logged in salt',
    'NONCE_SALT' => 'guide nonce salt',
] as $guide_name => $guide_value)
{
    defined($guide_name) || define($guide_name, $guide_value);
}
if (GUIDE_MULTISITE)
{
    foreach ([
        'MULTISITE' => true,
        'SUBDOMAIN_INSTALL' => false,
        'DOMAIN_CURRENT_SITE' => 'example.org',
        'PATH_CURRENT_SITE' => '/',
        'SITE_ID_CURRENT_SITE' => 1,
        'BLOG_ID_CURRENT_SITE' => 1,
    ] as $guide_name => $guide_value)
    {
        defined($guide_name) || define($guide_name, $guide_value);
    }
}
$GLOBALS['table_prefix'] = 'guide_';
$_SERVER['HTTP_HOST'] = 'example.org';
$_SERVER['REQUEST_URI'] = '/';
$_SERVER['REQUEST_METHOD'] = 'GET';
$_SERVER['SERVER_NAME'] = 'example.org';
$_SERVER['SERVER_PORT'] = '80';

// The tables and the options WordPress reads while it loads, written directly: WordPress isn't loaded yet.
$guide_mysqli = mysqli_connect(
    $guide_db['host'] ?? 'localhost',
    DB_USER,
    DB_PASSWORD,
    DB_NAME,
    (int) ($guide_db['port'] ?? 3306)
);
// As wpdb does for its own connection: without the strict modes WordPress's zero-date defaults fail under.
mysqli_query($guide_mysqli, "SET SESSION sql_mode = ''");
$guide_tables = mysqli_query($guide_mysqli, "SHOW TABLES LIKE 'guide\\_%'")->fetch_all();
if ($guide_tables)
{
    mysqli_query($guide_mysqli, 'DROP TABLE ' . implode(', ', array_column($guide_tables, 0)));
}
$guide_schema = (require __DIR__ . '/wordpress-schema.php')[GUIDE_MULTISITE ? 'multisite' : 'single'];
foreach (preg_split('/;\s*\n/', $guide_schema) as $guide_statement)
{
    if ('' !== trim($guide_statement))
    {
        mysqli_query($guide_mysqli, $guide_statement);
    }
}
require ABSPATH . WPINC . '/version.php';
foreach ([
    'siteurl' => 'http://example.org',
    'home' => 'http://example.org',
    'blogname' => 'Guide',
    'blogdescription' => 'Just another guide',
    'admin_email' => 'admin@example.org',
    'permalink_structure' => '',
    'template' => 'guide',
    'stylesheet' => 'guide',
    'active_plugins' => serialize([]),
    'db_version' => (string) $wp_db_version,
    'WPLANG' => '',
] as $guide_name => $guide_value)
{
    $guide_insert = mysqli_prepare(
        $guide_mysqli,
        "INSERT INTO guide_options (option_name, option_value, autoload) VALUES (?, ?, 'on')"
    );
    mysqli_stmt_bind_param($guide_insert, 'ss', $guide_name, $guide_value);
    mysqli_stmt_execute($guide_insert);
}
if (GUIDE_MULTISITE)
{
    // The network and its main site, as the network installer writes them.
    mysqli_query($guide_mysqli, "INSERT INTO guide_site (id, domain, path) VALUES (1, 'example.org', '/')");
    mysqli_query(
        $guide_mysqli,
        "INSERT INTO guide_blogs (blog_id, site_id, domain, path, registered, last_updated, public)"
        . " VALUES (1, 1, 'example.org', '/', '2026-03-01 09:00:00', '2026-03-01 09:00:00', 1)"
    );
    mysqli_query(
        $guide_mysqli,
        "INSERT INTO guide_sitemeta (site_id, meta_key, meta_value) VALUES (1, 'siteurl', 'http://example.org/'),"
        . " (1, 'site_name', 'Guide Network'), (1, 'admin_email', 'admin@example.org')"
    );
}
mysqli_close($guide_mysqli);
unset($guide_url, $guide_db, $guide_name, $guide_value, $guide_tables, $guide_schema, $guide_statement, $guide_insert);
unset($guide_mysqli);

require ABSPATH . 'wp-settings.php';

add_filter('pre_http_request', static function ($response)
{
    return false === $response ? new WP_Error('http_request_blocked', 'The guide sends no HTTP requests.') : $response;
}, PHP_INT_MAX);

// What the installer does after the tables: default options and roles, the first category, and the administrator.
require_once ABSPATH . 'wp-admin/includes/upgrade.php';
populate_options();
populate_roles();
if (GUIDE_MULTISITE)
{
    populate_network_meta(1, ['admin_email' => 'admin@example.org', 'subdomain_install' => 0]);
}
wp_cache_flush();
wp_insert_term('Uncategorized', 'category');
wp_set_current_user(wp_insert_user([
    'user_login' => 'admin',
    'user_pass' => 'password',
    'user_email' => 'admin@example.org',
    'display_name' => 'Admin',
    'role' => 'administrator',
]));
if (GUIDE_MULTISITE)
{
    update_site_option('site_admins', ['admin']);
}
