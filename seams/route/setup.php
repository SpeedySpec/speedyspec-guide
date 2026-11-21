<?php

declare(strict_types=1);

/**
 * The shared basic setup, plus a site with plain permalinks and an empty main query.
 *
 *  With no database, the options the rewrite rules and redirects read come from filters: the site is
 *  `http://example.org`, showing its latest posts, with plain permalinks, on the Twenty Twenty-Five theme with uploads in
 *  dated folders; reading any other option throws, naming it.
 *  `guide_permalinks()` switches the permalink structure and rebuilds `$wp_rewrite`. The main query is a `WP_Query`
 *  that has run no query, and the request is a front-end `GET` of `/hello/`.
 */

require __DIR__ . '/../basic-setup.php';

foreach ([
    'home' => 'http://example.org',
    'siteurl' => 'http://example.org',
    'show_on_front' => 'posts',
    'page_on_front' => '0',
    'permalink_structure' => '',
    'category_base' => '',
    'tag_base' => '',
    'wp_random_base' => '',
    'upload_path' => '',
    'upload_url_path' => '',
    'uploads_use_yearmonth_folders' => 1,
    'timezone_string' => '',
    'gmt_offset' => '0',
    'stylesheet' => 'twentytwentyfive',
    'template' => 'twentytwentyfive',
] as $guide_name => $guide_value)
{
    add_filter("pre_option_{$guide_name}", static fn () => $guide_value);
}
foreach (['OBJECT', 'OBJECT_K', 'ARRAY_A', 'ARRAY_N'] as $guide_name)
{
    defined($guide_name) || define($guide_name, $guide_name);
}
// default-constants.php's content and plugin locations.
foreach ([
    'WP_CONTENT_DIR' => ABSPATH . 'wp-content',
    'WP_CONTENT_URL' => 'http://example.org/wp-content',
    'WP_PLUGIN_DIR' => ABSPATH . 'wp-content/plugins',
    'WP_PLUGIN_URL' => 'http://example.org/wp-content/plugins',
    'WPMU_PLUGIN_DIR' => ABSPATH . 'wp-content/mu-plugins',
    'WPMU_PLUGIN_URL' => 'http://example.org/wp-content/mu-plugins',
] as $guide_name => $guide_value)
{
    defined($guide_name) || define($guide_name, $guide_value);
}
// Any other option would be read from the database; say which instead of failing on a missing $wpdb.
add_filter('pre_option', static function ($pre, $name) { if (false === $pre) { throw new RuntimeException('unanswered option ' . $name); } return $pre; }, 99, 2);
unset($guide_name, $guide_value);

// l10n.php is not loaded: the site is in English and never switches locale, so the default random base is `random`.
if (!function_exists('get_locale'))
{
    function get_locale()
    {
        return 'en_US';
    }
    function switch_to_locale($locale)
    {
        return false;
    }
    function restore_previous_locale()
    {
        return false;
    }
}

$_SERVER['HTTP_HOST'] = 'example.org';
$_SERVER['REQUEST_URI'] = '/hello/';
$_SERVER['REQUEST_METHOD'] = 'GET';

$GLOBALS['wp_rewrite'] = new WP_Rewrite();
$GLOBALS['wp'] = new WP();
$GLOBALS['wp_the_query'] = new WP_Query();
$GLOBALS['wp_query'] = $GLOBALS['wp_the_query'];

/** Switches the site to a permalink structure and rebuilds the rewrite object for it. */
function guide_permalinks(string $structure): WP_Rewrite
{
    add_filter('pre_option_permalink_structure', static fn () => $structure, 20);
    $GLOBALS['wp_rewrite']->init();
    return $GLOBALS['wp_rewrite'];
}

/**
 * Records that no page or post has the given path, where `get_page_by_path()` caches what it found.
 *
 *  The rewrite rules look for a page at the random base, `random`; with this, they find none without a query.
 */
function guide_no_page_at(string $path): void
{
    foreach (['page', 'post'] as $post_type)
    {
        wp_cache_set_salted('get_page_by_path:' . md5($path . serialize($post_type)), 0, 'post-queries', wp_cache_get_last_changed('posts'));
    }
}
guide_no_page_at('random');
