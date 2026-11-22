<?php

declare(strict_types=1);

/**
 * Gives each Navigation menus example a fresh site in MySQL (see `database.php`), with the post types and
 *  taxonomies `wp-settings.php` registers at `init`, and the default filter that makes slugs.
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
]);
// wp-settings.php: the rewrite rules, here with plain permalinks.
$GLOBALS['wp_rewrite'] = new WP_Rewrite();
create_initial_post_types();
create_initial_taxonomies();
// The line of default-filters.php that saving posts and terms depends on: slugs are made from titles with dashes.
add_filter('sanitize_title', 'sanitize_title_with_dashes', 10, 3);
