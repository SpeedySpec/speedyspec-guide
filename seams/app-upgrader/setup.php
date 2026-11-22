<?php

declare(strict_types=1);

/**
 * Gives each Upgrader example a freshly installed site, booted as WordPress boots (see `boot.php`), with the
 *  administrator `admin` (user 1) logged in and the admin's update, install and filesystem code loaded.
 *
 *  No request leaves the machine: {@link guide_queue_http()} answers the WordPress.org APIs with prepared responses,
 *  and files are written directly, never over FTP or SSH.
 */

require __DIR__ . '/../boot.php';

foreach (['function', 'argument', 'file', 'hook', 'constructor', 'class'] as $guide_kind)
{
    add_filter("deprecated_{$guide_kind}_trigger_error", '__return_false');
}
add_filter('doing_it_wrong_trigger_error', '__return_false');
unset($guide_kind);

defined('FS_METHOD') || define('FS_METHOD', 'direct');
require_once ABSPATH . 'wp-admin/includes/admin.php';
require_once ABSPATH . 'wp-admin/includes/plugin-install.php';
require_once ABSPATH . 'wp-admin/includes/theme-install.php';
require_once ABSPATH . 'wp-admin/includes/translation-install.php';
require_once ABSPATH . 'wp-admin/includes/upgrade.php';
require_once ABSPATH . 'wp-admin/includes/update-core.php';
require_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';

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
 * Records that WordPress.org offers a core update, as wp_version_check() would after asking.
 *
 * @param string $version
 *   The version offered.
 */
function guide_offer_core_update(string $version = '7.3'): void
{
    $offer = (object) [
        'response' => 'upgrade',
        'download' => "https://downloads.wordpress.org/release/wordpress-{$version}.zip",
        'locale' => 'en_US',
        'packages' => (object) ['full' => "https://downloads.wordpress.org/release/wordpress-{$version}.zip"],
        'current' => $version,
        'version' => $version,
        'php_version' => '7.4',
        'mysql_version' => '5.5.5',
        'new_bundled' => '6.7',
        'partial_version' => '',
    ];
    set_site_transient('update_core', (object) [
        'updates' => [$offer],
        'last_checked' => time(),
        'version_checked' => wp_get_wp_version(),
        'translations' => [],
    ]);
}
