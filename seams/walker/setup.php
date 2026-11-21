<?php

declare(strict_types=1);

/**
 * The shared basic setup, plus the site the walkers render links for.
 *
 *  With no database, the options the walkers read come from filters: the site is `http://example.org`, plain
 *  permalinks, no page for posts and no privacy policy page; reading any other option throws, naming it. `guide_page()` puts a page in the object cache, where
 *  `get_post()` finds it, as if it had been loaded from the database.
 */

require __DIR__ . '/../basic-setup.php';

defined('COOKIEHASH') || define('COOKIEHASH', md5('http://example.org'));
// class-wpdb.php's result types, which get_post() takes.
foreach (['OBJECT', 'OBJECT_K', 'ARRAY_A', 'ARRAY_N'] as $guide_name)
{
    defined($guide_name) || define($guide_name, $guide_name);
}

foreach ([
    'home' => 'http://example.org',
    'siteurl' => 'http://example.org',
    'permalink_structure' => '',
    'page_for_posts' => '0',
    'show_on_front' => 'posts',
    'wp_page_for_privacy_policy' => '0',
    'date_format' => 'Y-m-d',
    'time_format' => 'H:i',
    'timezone_string' => 'UTC',
    'gmt_offset' => '0',
    'wp_random_base' => '',
] as $guide_name => $guide_value)
{
    add_filter("pre_option_{$guide_name}", static fn () => $guide_value);
}

// Any other option would be read from the database; say which instead of failing on a missing $wpdb.
add_filter('pre_option', static function ($pre, $name) { if (false === $pre) { throw new RuntimeException('unanswered option ' . $name); } return $pre; }, 99, 2);
$GLOBALS['wp_rewrite'] = new WP_Rewrite();

/** Caches a published page, so the walkers can link to it without a database. */
function guide_page(int $id, string $title, int $parent = 0): WP_Post
{
    $page = new WP_Post((object) [
        'ID' => $id,
        'post_title' => $title,
        'post_parent' => $parent,
        'post_type' => 'page',
        'post_status' => 'publish',
        'post_name' => sanitize_title($title),
        'post_date' => '2026-01-02 03:04:05',
        'post_modified' => '2026-02-03 04:05:06',
        'filter' => 'raw',
    ]);
    wp_cache_set($id, $page, 'posts');
    return $page;
}

unset($guide_name, $guide_value);
