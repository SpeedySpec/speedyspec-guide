<?php

declare(strict_types=1);

/**
 * Gives each Options example a fresh WordPress to run on, after the seam's `wordpress` files are loaded.
 *
 * It connects `$wpdb` to the MySQL database in `GUIDE_MYSQL_URL`, recreates the `guide_` tables and seeds them, and
 * starts the object cache, as `wp-settings.php` would for a site with these options. With `GUIDE_MULTISITE` true it
 * is a multisite install instead: network 1, site 1, and `guide_sitemeta`.
 *
 * Seeded options (autoload `on`): siteurl and home `http://example.org`, blogname `Guide`, blogdescription
 * `Just another guide`, admin_email `admin@example.org`. Seeded network options (multisite): site_name
 * `Guide Network`, siteurl `http://example.org/`, admin_email `admin@example.org`. User 1 is `admin`, an
 *  administrator of site 1 (the `guide_user_roles` option and its `guide_capabilities` user meta).
 */

$guide_url = getenv('GUIDE_MYSQL_URL');
if (!$guide_url)
{
    throw new RuntimeException('Options examples need a MySQL database: set GUIDE_MYSQL_URL');
}
$guide_db = parse_url($guide_url);

foreach ([
    'WP_CONTENT_DIR' => ABSPATH . 'wp-content',
    'WP_DEBUG' => false,
    'WP_DEBUG_DISPLAY' => false,
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
// default-constants.php: the time and cookie constants the user settings functions use.
foreach ([
    'MINUTE_IN_SECONDS' => 60,
    'HOUR_IN_SECONDS' => 3600,
    'DAY_IN_SECONDS' => 86400,
    'WEEK_IN_SECONDS' => 604800,
    'MONTH_IN_SECONDS' => 2592000,
    'YEAR_IN_SECONDS' => 31536000,
    'COOKIEPATH' => '/',
    'SITECOOKIEPATH' => '/',
] as $guide_name => $guide_value)
{
    defined($guide_name) || define($guide_name, $guide_value);
}
if (GUIDE_MULTISITE)
{
    define('MULTISITE', true);
    define('SUBDOMAIN_INSTALL', false);
    define('DOMAIN_CURRENT_SITE', 'example.org');
    define('PATH_CURRENT_SITE', '/');
    define('SITE_ID_CURRENT_SITE', 1);
    define('BLOG_ID_CURRENT_SITE', 1);
}

// l10n.php is not loaded: text comes back untranslated.
if (!function_exists('__'))
{
    function __($text, $domain = 'default')
    {
        return $text;
    }
}
if (!function_exists('_x'))
{
    function _x($text, $context, $domain = 'default')
    {
        return $text;
    }
}

/** What `wp_die()` throws here, so an example can show where WordPress would stop the page. */
class WPDieException extends Exception
{
}

/** The `wp_die` handler: throws the message instead of printing a page. */
function guide_wp_die($message, $title = '', $args = array())
{
    throw new WPDieException(is_string($message) ? $message : '');
}

// ms-settings.php: the current network and site.
$GLOBALS['blog_id'] = 1;
$GLOBALS['site_id'] = 1;
if (GUIDE_MULTISITE)
{
    $GLOBALS['current_site'] = new WP_Network((object) [
        'id' => 1,
        'domain' => 'example.org',
        'path' => '/',
        'blog_id' => 1,
        'site_name' => 'Guide Network',
        'cookie_domain' => 'example.org',
    ]);
}

$GLOBALS['wpdb'] = new wpdb(DB_USER, DB_PASSWORD, DB_NAME, DB_HOST);
$GLOBALS['wpdb']->set_prefix('guide_');
if (GUIDE_MULTISITE)
{
    $GLOBALS['wpdb']->set_blog_id(1, 1);
}

/** Recreates the guide's tables, with WordPress's schema for them, and seeds them. */
function guide_tables(): void
{
    global $wpdb;
    $charset = 'DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci';
    $wpdb->query('DROP TABLE IF EXISTS guide_options, guide_sitemeta, guide_users, guide_usermeta');
    $wpdb->query("CREATE TABLE guide_options (option_id bigint(20) unsigned NOT NULL auto_increment, option_name varchar(191) NOT NULL default '', option_value longtext NOT NULL, autoload varchar(20) NOT NULL default 'yes', PRIMARY KEY (option_id), UNIQUE KEY option_name (option_name), KEY autoload (autoload)) $charset");
    $wpdb->query("CREATE TABLE guide_sitemeta (meta_id bigint(20) unsigned NOT NULL auto_increment, site_id bigint(20) unsigned NOT NULL default '0', meta_key varchar(255) default NULL, meta_value longtext, PRIMARY KEY (meta_id), KEY meta_key (meta_key(191)), KEY site_id (site_id)) $charset");
    $wpdb->query("CREATE TABLE guide_users (ID bigint(20) unsigned NOT NULL auto_increment, user_login varchar(60) NOT NULL default '', user_pass varchar(255) NOT NULL default '', user_nicename varchar(50) NOT NULL default '', user_email varchar(100) NOT NULL default '', user_url varchar(100) NOT NULL default '', user_registered datetime NOT NULL default '0000-00-00 00:00:00', user_activation_key varchar(255) NOT NULL default '', user_status int(11) NOT NULL default '0', display_name varchar(250) NOT NULL default '', PRIMARY KEY (ID), KEY user_login_key (user_login), KEY user_nicename (user_nicename), KEY user_email (user_email)) $charset");
    $wpdb->query("CREATE TABLE guide_usermeta (umeta_id bigint(20) unsigned NOT NULL auto_increment, user_id bigint(20) unsigned NOT NULL default '0', meta_key varchar(255) default NULL, meta_value longtext, PRIMARY KEY (umeta_id), KEY user_id (user_id), KEY meta_key (meta_key(191))) $charset");
    foreach ([
        'siteurl' => 'http://example.org',
        'home' => 'http://example.org',
        'blogname' => 'Guide',
        'blogdescription' => 'Just another guide',
        'admin_email' => 'admin@example.org',
    ] as $name => $value)
    {
        $wpdb->insert('guide_options', ['option_name' => $name, 'option_value' => $value, 'autoload' => 'on']);
    }
    $wpdb->insert('guide_users', ['user_login' => 'admin', 'user_nicename' => 'admin', 'user_email' => 'admin@example.org', 'display_name' => 'admin', 'user_registered' => '2026-01-01 00:00:00']);
    // User 1 is an administrator of site 1, so the user settings functions treat it as a member of the site.
    $wpdb->insert('guide_options', ['option_name' => 'guide_user_roles', 'option_value' => serialize(['administrator' => ['name' => 'Administrator', 'capabilities' => ['read' => true]]]), 'autoload' => 'off']);
    $wpdb->insert('guide_usermeta', ['user_id' => 1, 'meta_key' => 'guide_capabilities', 'meta_value' => serialize(['administrator' => true])]);
    if (GUIDE_MULTISITE)
    {
        foreach (['site_name' => 'Guide Network', 'siteurl' => 'http://example.org/', 'admin_email' => 'admin@example.org'] as $key => $value)
        {
            $wpdb->insert('guide_sitemeta', ['site_id' => 1, 'meta_key' => $key, 'meta_value' => $value]);
        }
    }
}
guide_tables();

wp_cache_init();
// wp_start_object_cache()'s global groups.
wp_cache_add_global_groups(
    ['blog-details', 'blog-id-cache', 'blog-lookup', 'blog_meta', 'global-posts', 'image_editor', 'networks',
        'network-queries', 'sites', 'site-details', 'site-options', 'site-queries', 'site-transient', 'theme_files',
        'translation_files', 'rss', 'users', 'user-queries', 'user_meta', 'useremail', 'userlogins', 'userslugs']
);

// `init` has run, so wpdb loads no translations early.
do_action('init');
add_filter('wp_die_handler', static fn () => 'guide_wp_die');
// The one line of default-filters.php the option functions depend on.
add_filter('wp_default_autoload_value', 'wp_filter_default_autoload_value_via_option_size', 5, 4);

unset($guide_url, $guide_db, $guide_name, $guide_value);
