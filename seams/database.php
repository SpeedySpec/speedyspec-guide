<?php

declare(strict_types=1);

/**
 * Gives a seam's examples a fresh WordPress database, for seams whose functions store posts, terms, meta or users.
 *
 *  It connects `$wpdb` to the MySQL database in `GUIDE_MYSQL_URL` with the table prefix `guide_`, and
 *  {@link guide_database()} recreates WordPress's tables there from `wp_get_db_schema()`, as an install would, and
 *  seeds the options given. The object cache starts empty with `wp_start_object_cache()`'s global groups. The seam's
 *  `seam.yaml` sets `mysql: true` and loads `class-wpdb.php` and the object cache.
 *
 *  With `GUIDE_MULTISITE`, it is a subdirectory network instead, as `ms-settings.php` would load it: network 1 at
 *  `example.org/` named `Guide Network`, its main site 1, and the network tables. The seam then also loads
 *  `class-wp-network.php`, `class-wp-site.php`, `ms-network.php`, `ms-site.php`, `ms-blogs.php` and
 *  `ms-functions.php`.
 */

$guide_url = getenv('GUIDE_MYSQL_URL');
if (!$guide_url)
{
    throw new RuntimeException('this seam\'s examples need a MySQL database: set GUIDE_MYSQL_URL');
}
$guide_db = parse_url($guide_url);
foreach ([
    'WP_CONTENT_DIR' => ABSPATH . 'wp-content',
    'DB_NAME' => ltrim($guide_db['path'] ?? '', '/'),
    'DB_USER' => urldecode($guide_db['user'] ?? ''),
    'DB_PASSWORD' => urldecode($guide_db['pass'] ?? ''),
    'DB_HOST' => ($guide_db['host'] ?? 'localhost') . (isset($guide_db['port']) ? ':' . $guide_db['port'] : ''),
    'DB_CHARSET' => 'utf8mb4',
    'DB_COLLATE' => '',
] as $guide_name => $guide_value)
{
    defined($guide_name) || define($guide_name, $guide_value);
}
if (GUIDE_MULTISITE)
{
    foreach ([
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

// wpdb falls back to loading translations when it can't connect, which hides why; say so plainly instead.
try
{
    $guide_port = (int) ($guide_db['port'] ?? 3306);
    mysqli_close(mysqli_connect($guide_db['host'] ?? 'localhost', DB_USER, DB_PASSWORD, DB_NAME, $guide_port));
}
catch (mysqli_sql_exception $guide_error)
{
    throw new RuntimeException(
        'cannot connect to the MySQL database in GUIDE_MYSQL_URL: ' . $guide_error->getMessage()
    );
}
$GLOBALS['wpdb'] = new wpdb(DB_USER, DB_PASSWORD, DB_NAME, DB_HOST);
$GLOBALS['wpdb']->set_prefix('guide_');
if (GUIDE_MULTISITE)
{
    $GLOBALS['wpdb']->set_blog_id(1, 1);
}
unset($guide_url, $guide_db, $guide_name, $guide_value, $guide_port);

/**
 * Recreates WordPress's tables with the `guide_` prefix and seeds the options, as a fresh install would.
 *
 * @param array<string, mixed> $options
 *   The options to seed, autoloaded; arrays and objects are stored serialized.
 */
function guide_database(array $options): void
{
    global $wpdb;
    $tables = $wpdb->get_col("SHOW TABLES LIKE 'guide\\_%'");
    if ($tables)
    {
        $wpdb->query('DROP TABLE ' . implode(', ', $tables));
    }
    require_once ABSPATH . 'wp-admin/includes/schema.php';
    foreach (preg_split('/;\s*\n/', wp_get_db_schema('all')) as $statement)
    {
        if ('' !== trim($statement))
        {
            $wpdb->query($statement);
        }
    }
    foreach ($options as $name => $value)
    {
        $wpdb->insert(
            $wpdb->options,
            ['option_name' => $name, 'option_value' => maybe_serialize($value), 'autoload' => 'on']
        );
    }
    if (GUIDE_MULTISITE)
    {
        $wpdb->insert($wpdb->site, ['id' => 1, 'domain' => 'example.org', 'path' => '/']);
        $wpdb->insert($wpdb->blogs, [
            'blog_id' => 1,
            'site_id' => 1,
            'domain' => 'example.org',
            'path' => '/',
            'registered' => '2026-01-01 00:00:00',
            'last_updated' => '2026-01-01 00:00:00',
            'public' => 1,
        ]);
        foreach ([
            'site_name' => 'Guide Network',
            'siteurl' => 'http://example.org/',
            'admin_email' => 'admin@example.org',
            'registration' => 'all',
            'illegal_names' => ['www', 'web', 'root', 'admin', 'main', 'invite', 'administrator', 'files'],
            'limited_email_domains' => '',
            'banned_email_domains' => '',
            'WPLANG' => '',
        ] as $key => $value)
        {
            $wpdb->insert(
                $wpdb->sitemeta,
                ['site_id' => 1, 'meta_key' => $key, 'meta_value' => maybe_serialize($value)]
            );
        }
    }
    wp_cache_init();
    wp_cache_add_global_groups(
        ['blog-details', 'blog-id-cache', 'blog-lookup', 'blog_meta', 'global-posts', 'image_editor', 'networks',
            'network-queries', 'sites', 'site-details', 'site-options', 'site-queries', 'site-transient', 'theme_files',
            'translation_files', 'rss', 'users', 'user-queries', 'user_meta', 'useremail', 'userlogins', 'userslugs']
    );
    if (GUIDE_MULTISITE)
    {
        // ms-settings.php: the current network and site.
        $GLOBALS['current_site'] = WP_Network::get_instance(1);
        $GLOBALS['current_blog'] = WP_Site::get_instance(1);
        $GLOBALS['blog_id'] = 1;
        $GLOBALS['site_id'] = 1;
        $GLOBALS['domain'] = 'example.org';
        $GLOBALS['path'] = '/';
    }
}
