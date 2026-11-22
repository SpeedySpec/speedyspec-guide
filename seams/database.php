<?php

declare(strict_types=1);

/**
 * Gives a seam's examples a fresh WordPress database, for seams whose functions store posts, terms, meta or users.
 *
 *  It connects `$wpdb` to the MySQL database in `GUIDE_MYSQL_URL` with the table prefix `guide_`, and
 *  {@link guide_database()} recreates WordPress's tables there from `wp_get_db_schema()`, as an install would, and
 *  seeds the options given. The object cache starts empty with `wp_start_object_cache()`'s global groups. The seam's
 *  `seam.yaml` sets `mysql: true` and loads `class-wpdb.php` and the object cache.
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

// wpdb falls back to loading translations when it can't connect, which hides why; say so plainly instead.
try
{
    mysqli_close(mysqli_connect($guide_db['host'] ?? 'localhost', DB_USER, DB_PASSWORD, DB_NAME, (int) ($guide_db['port'] ?? 3306)));
}
catch (mysqli_sql_exception $guide_error)
{
    throw new RuntimeException('cannot connect to the MySQL database in GUIDE_MYSQL_URL: ' . $guide_error->getMessage());
}
$GLOBALS['wpdb'] = new wpdb(DB_USER, DB_PASSWORD, DB_NAME, DB_HOST);
$GLOBALS['wpdb']->set_prefix('guide_');
unset($guide_url, $guide_db, $guide_name, $guide_value);

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
        $wpdb->insert($wpdb->options, ['option_name' => $name, 'option_value' => maybe_serialize($value), 'autoload' => 'on']);
    }
    wp_cache_init();
    wp_cache_add_global_groups(
        ['blog-details', 'blog-id-cache', 'blog-lookup', 'blog_meta', 'global-posts', 'image_editor', 'networks',
            'network-queries', 'sites', 'site-details', 'site-options', 'site-queries', 'site-transient', 'theme_files',
            'translation_files', 'rss', 'users', 'user-queries', 'user_meta', 'useremail', 'userlogins', 'userslugs']
    );
}
