<?php

declare(strict_types=1);

/**
 * Gives each Admin example a freshly installed site, booted as WordPress boots (see `boot.php`), with the
 *  administrator `admin` (user 1) logged in and the admin's includes and Ajax handlers loaded.
 *
 *  {@link guide_ajax()} runs an Ajax handler and gives back what it sent, since handlers end the request.
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
require_once ABSPATH . 'wp-admin/includes/ajax-actions.php';

/** Runs a function that prints and gives back what it printed, each run of whitespace collapsed to one space. */
function guide_render(callable $print): string
{
    ob_start();
    $print();
    return trim(preg_replace('/\s+/', ' ', ob_get_clean()));
}

/**
 * Answers the next HTTP requests with these bodies, as JSON, through pre_http_request.
 *
 * @param array<int, array<string, mixed>|string> $bodies
 *   The responses in order; an array is sent as JSON with status 200, a string as HTML.
 */
function guide_queue_http(array $bodies): void
{
    add_filter('pre_http_request', static function ($pre, $args, $url) use (&$bodies)
    {
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


/** Thrown by {@link guide_ajax_stop()} to end an Ajax handler without ending the example. */
final class Guide_Ajax_Stop extends RuntimeException
{
}

/**
 * Ends an Ajax request by throwing, in place of WordPress's die(), printing a scalar message first as WordPress does.
 *
 * @param mixed $message
 *   The message wp_die() was given.
 */
function guide_ajax_stop($message = ''): void
{
    if (is_scalar($message))
    {
        echo (string) $message;
    }
    throw new Guide_Ajax_Stop();
}

/** Gives {@link guide_ajax_stop()} as the handler wp_die() uses during Ajax requests. */
function guide_ajax_die_handler(): string
{
    return 'guide_ajax_stop';
}

/**
 * Runs an Ajax handler as admin-ajax.php would, with request values and a valid nonce, and gives back what it sent.
 *
 * @param callable $handler
 *   The handler, such as `wp_ajax_add_tag`.
 * @param array<string, mixed> $request
 *   The request values; `_ajax_nonce` is filled from `$nonce_action` when given.
 * @param string|int $nonce_action
 *   The nonce action the handler checks, or -1 for none.
 */
function guide_ajax(callable $handler, array $request = [], $nonce_action = -1): string
{
    add_filter('wp_doing_ajax', '__return_true');
    add_filter('wp_die_ajax_handler', 'guide_ajax_die_handler');
    if (-1 !== $nonce_action)
    {
        $request += ['_ajax_nonce' => wp_create_nonce($nonce_action), '_wpnonce' => wp_create_nonce($nonce_action)];
    }
    $_POST = $request;
    $_GET = $request;
    $_REQUEST = $request;
    ob_start();
    try
    {
        $handler();
    }
    catch (Guide_Ajax_Stop $stop)
    {
    }
    $sent = (string) ob_get_clean();
    remove_filter('wp_die_ajax_handler', 'guide_ajax_die_handler');
    remove_filter('wp_doing_ajax', '__return_true');
    return $sent;
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

/**
 * Builds the admin menus as wp-admin/menu.php does for the logged-in user, so menu functions find their parents.
 *
 *  menu.php runs in the global scope on a real request, so its variables are made global first.
 */
function guide_admin_menu(): void
{
    global $menu, $submenu, $compat, $_wp_real_parent_file, $_wp_submenu_nopriv, $_wp_menu_nopriv, $admin_page_hooks,
        $_registered_pages, $_parent_pages, $_wp_last_object_menu, $_wp_last_utility_menu, $self, $parent_file,
        $submenu_file, $plugin_page, $typenow, $pagenow;
    $pagenow = $pagenow ?: 'index.php';
    require ABSPATH . 'wp-admin/menu.php';
}
