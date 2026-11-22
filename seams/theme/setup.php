<?php

declare(strict_types=1);

/**
 * Gives each Themes and templates example a freshly installed site, booted as WordPress boots (see `boot.php`),
 *  with the administrator `admin` (user 1) logged in.
 *
 *  {@link guide_go()} runs the main query for a URL as a front-end request would, so the template tags answer for
 *  that page.
 */

require __DIR__ . '/../boot.php';

foreach (['function', 'argument', 'file', 'hook', 'constructor', 'class'] as $guide_kind)
{
    add_filter("deprecated_{$guide_kind}_trigger_error", '__return_false');
}
add_filter('doing_it_wrong_trigger_error', '__return_false');
unset($guide_kind);

/**
 * Runs the main query for a URL of the site, as the front end would for that request.
 *
 * @param string $url
 *   A URL of the site, or a path or query string such as `/?p=1`.
 */
function guide_go(string $url): WP_Query
{
    $parts = parse_url($url);
    $_SERVER['REQUEST_URI'] = ($parts['path'] ?? '/') . (isset($parts['query']) ? '?' . $parts['query'] : '');
    $_GET = [];
    parse_str($parts['query'] ?? '', $_GET);
    $GLOBALS['wp']->main();
    return $GLOBALS['wp_query'];
}

/** Runs a function that prints and gives back what it printed, each run of whitespace collapsed to one space. */
function guide_render(callable $print): string
{
    ob_start();
    $print();
    return trim(preg_replace('/\s+/', ' ', ob_get_clean()));
}
