<?php

declare(strict_types=1);

/**
 * Gives each Taxonomies and metadata example a fresh site in MySQL (see `database.php`), with the post types and
 *  taxonomies `wp-settings.php` registers at `init`, and the default filters that make slugs and format lists.
 *
 *  Options: siteurl and home `http://example.org`, blogname `Guide`, stylesheet and template `guide`, so the theme
 *  mods live in `theme_mods_guide`.
 */

require __DIR__ . '/../basic-setup.php';
require __DIR__ . '/../database.php';

// default-constants.php: trashed posts are kept 30 days.
defined('EMPTY_TRASH_DAYS') || define('EMPTY_TRASH_DAYS', 30);

guide_database([
    'siteurl' => 'http://example.org',
    'home' => 'http://example.org',
    'blogname' => 'Guide',
    'stylesheet' => 'guide',
    'template' => 'guide',
    'permalink_structure' => '',
    'default_category' => 1,
    'db_version' => 60000,
    'date_format' => 'F j, Y',
]);
// wp-settings.php: the rewrite rules, here with plain permalinks.
$GLOBALS['wp_rewrite'] = new WP_Rewrite();
create_initial_post_types();
create_initial_taxonomies();
// The line of default-filters.php that saving posts and terms depends on: slugs are made from titles with dashes.
add_filter('sanitize_title', 'sanitize_title_with_dashes', 10, 3);
// default-filters.php: wp_sprintf() lists (%l), which term lists use.
add_filter('wp_sprintf', 'wp_sprintf_l', 10, 2);
// wp-settings.php: the WP object, which holds the query variables taxonomies add.
$GLOBALS['wp'] = new WP();

/** Runs a function that prints and gives back what it printed. */
function guide_render_out(callable $print): string
{
    ob_start();
    $print();
    return ob_get_clean();
}
