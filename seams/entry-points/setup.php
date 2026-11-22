<?php

declare(strict_types=1);

/**
 * Gives each Entry points example a fresh site in MySQL (see `database.php`), or with `"multisite": true` a fresh
 *  network, with the post types and taxonomies `wp-settings.php` registers at `init`.
 *
 *  Options: siteurl and home `http://example.org`, blogname `Guide`, admin_email `admin@example.org`, stylesheet and
 *  template `guide`. The request is a GET for `/`.
 */

require __DIR__ . '/../basic-setup.php';
require __DIR__ . '/../database.php';

defined('EMPTY_TRASH_DAYS') || define('EMPTY_TRASH_DAYS', 30);
$_SERVER['REQUEST_URI'] = '/';
$_SERVER['REQUEST_METHOD'] = 'GET';
$_SERVER['HTTP_HOST'] = 'example.org';

guide_database([
    'siteurl' => 'http://example.org',
    'home' => 'http://example.org',
    'blogname' => 'Guide',
    'admin_email' => 'admin@example.org',
    'stylesheet' => 'guide',
    'template' => 'guide',
    'permalink_structure' => '',
    'default_category' => 1,
    'blog_charset' => 'UTF-8',
    'html_type' => 'text/html',
    'users_can_register' => 0,
]);
// wp-settings.php: translations (none are installed), the locale, and the rewrite rules.
defined('WP_LANG_DIR') || define('WP_LANG_DIR', WP_CONTENT_DIR . '/languages');
$GLOBALS['wp_textdomain_registry'] = new WP_Textdomain_Registry();
$GLOBALS['wp_textdomain_registry']->init();
$GLOBALS['wp_locale'] = new WP_Locale();
$GLOBALS['wp_locale_switcher'] = new WP_Locale_Switcher();
$GLOBALS['wp_rewrite'] = new WP_Rewrite();
create_initial_post_types();
create_initial_taxonomies();
add_filter('sanitize_title', 'sanitize_title_with_dashes', 10, 3);

/**
 * Runs a function that prints a page part and gives back what it printed, with each run of whitespace collapsed to
 * one space, so long HTML reads on a few lines.
 */
function guide_render(callable $print): string
{
    ob_start();
    $print();
    return trim(preg_replace('/\s+/', ' ', ob_get_clean()));
}

/** Logs in a new administrator, `ada`, as the current user. */
function guide_log_in(): WP_User
{
    $id = wp_insert_user([
        'user_login' => 'ada',
        'user_email' => 'ada@example.org',
        'user_pass' => 'secret',
        'display_name' => 'Ada',
        'role' => 'administrator',
    ]);
    wp_set_current_user($id);
    return wp_get_current_user();
}
