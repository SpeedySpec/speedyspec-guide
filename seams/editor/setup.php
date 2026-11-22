<?php

declare(strict_types=1);

/**
 * Gives each Editor and embeds example a fresh site in MySQL (see `database.php`), with the post types and
 *  taxonomies `wp-settings.php` registers at `init`, the global `$wp_embed`, and plain permalinks.
 *
 *  Options: siteurl and home `http://example.org`, blogname `Guide`, admin_email `admin@example.org`, stylesheet and
 *  template `guide`. The request is a GET for `/`. oEmbed requests to other sites are answered by
 *  {@link guide_queue_http()} instead of going out.
 */

require __DIR__ . '/../basic-setup.php';
require __DIR__ . '/../database.php';

// default-constants.php: trash, sizes and memory limits.
foreach ([
    'EMPTY_TRASH_DAYS' => 30,
    'MB_IN_BYTES' => 1024 * 1024,
    'GB_IN_BYTES' => 1024 * 1024 * 1024,
    'WP_MEMORY_LIMIT' => '40M',
    'WP_MAX_MEMORY_LIMIT' => '256M',
    'SCRIPT_DEBUG' => false,
] as $guide_name => $guide_value)
{
    defined($guide_name) || define($guide_name, $guide_value);
}
unset($guide_name, $guide_value);
defined('WP_LANG_DIR') || define('WP_LANG_DIR', WP_CONTENT_DIR . '/languages');
$_SERVER['REQUEST_URI'] = '/';
$_SERVER['REQUEST_METHOD'] = 'GET';
$_SERVER['HTTP_HOST'] = 'example.org';

guide_database([
    'siteurl' => 'http://example.org',
    'home' => 'http://example.org',
    'blogname' => 'Guide',
    'blogdescription' => 'Just another guide',
    'admin_email' => 'admin@example.org',
    'stylesheet' => 'guide',
    'template' => 'guide',
    'permalink_structure' => '',
    'default_category' => 1,
    'blog_charset' => 'UTF-8',
    'html_type' => 'text/html',
    'embed_size_w' => '',
    'embed_size_h' => '',
]);
$GLOBALS['wp_textdomain_registry'] = new WP_Textdomain_Registry();
$GLOBALS['wp_textdomain_registry']->init();
$GLOBALS['wp_locale'] = new WP_Locale();
$GLOBALS['wp_locale_switcher'] = new WP_Locale_Switcher();
$GLOBALS['wp_rewrite'] = new WP_Rewrite();
create_initial_post_types();
create_initial_taxonomies();
add_filter('sanitize_title', 'sanitize_title_with_dashes', 10, 3);
$GLOBALS['wp_embed'] = new WP_Embed();

/** Runs a function that prints and gives back what it printed, each run of whitespace collapsed to one space. */
function guide_render(callable $print): string
{
    ob_start();
    $print();
    return trim(preg_replace('/\s+/', ' ', ob_get_clean()));
}

/**
 * Answers the next HTTP requests with these bodies, as JSON, through pre_http_request, printing each URL requested.
 *
 * @param array<int, array<string, mixed>|string> $bodies
 *   The responses in order; an array is sent as JSON with status 200, a string as HTML.
 */
function guide_queue_http(array $bodies): void
{
    add_filter('pre_http_request', static function ($pre, $args, $url) use (&$bodies)
    {
        echo 'request ', $url, "\n";
        $body = array_shift($bodies);
        if (null === $body)
        {
            return [
                'headers' => [],
                'body' => '',
                'response' => ['code' => 404, 'message' => 'Not Found'],
                'cookies' => [],
            ];
        }
        return [
            'headers' => ['content-type' => is_array($body) ? 'application/json' : 'text/html'],
            'body' => is_array($body) ? wp_json_encode($body) : $body,
            'response' => ['code' => 200, 'message' => 'OK'],
            'cookies' => [],
        ];
    }, 10, 3);
}

/**
 * Makes a post the main query's post and the current post, as when WordPress serves its page.
 *
 * @param array<string, mixed> $vars
 *   Extra query variables, such as `embed` for the post's embed view.
 */
function guide_view(int $post_id, array $vars = []): WP_Post
{
    $GLOBALS['wp_the_query'] = new WP_Query();
    $GLOBALS['wp_query'] = $GLOBALS['wp_the_query'];
    $GLOBALS['wp_query']->query(['p' => $post_id, 'post_type' => 'any'] + $vars);
    $GLOBALS['wp_query']->the_post();
    return get_post();
}

/** Publishes a post titled Hello with some content, and returns its ID. */
function guide_post(array $fields = []): int
{
    return wp_insert_post($fields + [
        'post_title' => 'Hello',
        'post_content' => 'The first words of a longer post about many things.',
        'post_status' => 'publish',
    ]);
}
