<?php

declare(strict_types=1);

/**
 * Gives each Deprecated example a freshly installed site, booted as WordPress boots (see `boot.php`), with the
 *  deprecation notices reported to the example instead of raised as errors.
 */

require __DIR__ . '/../boot.php';

foreach (['function', 'argument', 'file', 'hook', 'constructor', 'class'] as $guide_kind)
{
    add_filter("deprecated_{$guide_kind}_trigger_error", '__return_false');
}
unset($guide_kind);

/**
 * Makes the content the examples use and shows a post, as when WordPress serves its page: a published post by the
 * administrator in Uncategorized with a tag and an approved comment, a page, and user meta for the author fields.
 *
 * @return array<string, int>
 *   The IDs: `post`, `page`, `comment`, `category` and `user`.
 */
function guide_fixtures(): array
{
    $post = wp_insert_post([
        'post_title' => 'Hello',
        'post_content' => 'The first words of the post.',
        'post_status' => 'publish',
        'post_author' => 1,
        'post_date' => '2026-03-05 10:00:00',
        'tags_input' => ['alpha'],
    ]);
    $page = wp_insert_post([
        'post_title' => 'About',
        'post_type' => 'page',
        'post_status' => 'publish',
        'post_date' => '2026-03-01 09:00:00',
    ]);
    $comment = wp_insert_comment([
        'comment_post_ID' => $post,
        'comment_author' => 'Ada',
        'comment_content' => 'Nice',
        'comment_approved' => 1,
        'comment_date' => '2026-03-05 11:00:00',
        'comment_date_gmt' => '2026-03-05 11:00:00',
    ]);
    $meta = ['description' => 'Writes the guide.', 'first_name' => 'Ada', 'last_name' => 'Admin', 'nickname' => 'ada'];
    foreach ($meta as $key => $value)
    {
        update_user_meta(1, $key, $value);
    }
    wp_update_user(['ID' => 1, 'user_url' => 'https://admin.example']);
    $GLOBALS['wp_query'] = new WP_Query(['p' => $post]);
    $GLOBALS['wp_the_query'] = $GLOBALS['wp_query'];
    $GLOBALS['wp_query']->the_post();
    return ['post' => $post, 'page' => $page, 'comment' => $comment, 'category' => 1, 'user' => 1];
}

/**
 * Calls a deprecated function, printing the notice WordPress reports for it, and gives back what it returned and
 * printed.
 *
 * @return array{0: mixed, 1: string}
 *   The return value and the output, with each run of whitespace collapsed.
 */
function guide_deprecated(string $function, mixed ...$args): array
{
    add_action('deprecated_function_run', static function ($name, $replacement, $version): void
    {
        echo "deprecated {$name} since {$version}", $replacement ? ", use {$replacement}" : '', "\n";
    }, 10, 3);
    ob_start();
    $result = $function(...$args);
    $printed = trim(preg_replace('/\s+/', ' ', ob_get_clean()));
    return [$result, $printed];
}
