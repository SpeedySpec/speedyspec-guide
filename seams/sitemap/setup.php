<?php

declare(strict_types=1);

/**
 * The shared basic setup, plus a public site with plain or pretty permalinks.
 *
 *  With no database, the options the sitemaps read come from filters: the site is `http://example.org`, public,
 *  showing its latest posts on the front page, with plain permalinks; reading any other option throws, naming it.
 *  `guide_pretty_permalinks()` switches to `/%postname%/`. The providers' lists and page counts come from their
 *  `pre_url_list` and `pre_max_num_pages` filters, which an example sets, as a database would otherwise answer them.
 */

require __DIR__ . '/../basic-setup.php';

foreach ([
    'home' => 'http://example.org',
    'siteurl' => 'http://example.org',
    'blog_public' => '1',
    'show_on_front' => 'posts',
    'permalink_structure' => '',
    'wp_random_base' => '',
] as $guide_name => $guide_value)
{
    add_filter("pre_option_{$guide_name}", static fn () => $guide_value);
}
foreach (['OBJECT', 'OBJECT_K', 'ARRAY_A', 'ARRAY_N'] as $guide_name)
{
    defined($guide_name) || define($guide_name, $guide_name);
}
// Any other option would be read from the database; say which instead of failing on a missing $wpdb.
add_filter('pre_option', static function ($pre, $name) { if (false === $pre) { throw new RuntimeException('unanswered option ' . $name); } return $pre; }, 99, 2);
unset($guide_name, $guide_value);

$GLOBALS['wp_rewrite'] = new WP_Rewrite();
// wp-settings.php's WP object: the sitemaps add their query vars to it.
$GLOBALS['wp'] = new WP();

/** Switches the site to `/%postname%/` permalinks. */
function guide_pretty_permalinks(): void
{
    add_filter('pre_option_permalink_structure', static fn () => '/%postname%/', 20);
    $GLOBALS['wp_rewrite']->init();
}
