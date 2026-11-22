<?php

declare(strict_types=1);

/**
 * Gives each Support example a freshly installed site, booted as WordPress boots (see `boot.php`), with the
 *  administrator `admin` (user 1, password `password`) logged in.
 *
 *  Emails are shown instead of sent. Deprecation and doing-it-wrong notices are left to the actions WordPress fires
 *  for them instead of raised as errors. `wp_die()` stops the example's call instead of the request: every one of its
 *  handlers is replaced by one that throws, so {@link guide_dies()} can report what it would have shown.
 */

require __DIR__ . '/../boot.php';

foreach (['function', 'argument', 'file', 'hook', 'constructor', 'class'] as $guide_kind)
{
    add_filter("deprecated_{$guide_kind}_trigger_error", '__return_false');
}
add_filter('doing_it_wrong_trigger_error', '__return_false');
add_filter('pre_wp_mail', static function ($sent, array $atts)
{
    echo 'email to ', is_array($atts['to']) ? implode(', ', $atts['to']) : $atts['to'], ': ', $atts['subject'], "\n";
    return true;
}, 10, 2);
foreach (['wp_die_handler', 'wp_die_ajax_handler', 'wp_die_json_handler', 'wp_die_jsonp_handler',
    'wp_die_xmlrpc_handler', 'wp_die_xml_handler'] as $guide_filter)
{
    add_filter($guide_filter, static fn() => 'guide_die_handler', PHP_INT_MAX);
}
unset($guide_kind, $guide_filter);

/** What `wp_die()` was given, thrown in place of ending the request. */
final class Guide_Died extends RuntimeException
{
    public function __construct(public readonly mixed $died, public readonly string $title, public readonly array $args)
    {
        parent::__construct(is_wp_error($died) ? $died->get_error_message() : (string) $died);
    }
}

/** Throws what `wp_die()` was given, with the handler it would have used named in the arguments. */
function guide_die_handler(mixed $message, mixed $title = '', mixed $args = []): never
{
    throw new Guide_Died($message, (string) $title, (array) $args);
}

/**
 * Runs a function that ends the request through `wp_die()`, and describes how it would have ended.
 *
 * @return array{output: string, message: string, title: string, response: mixed}|string
 *   What was printed, the message, title and response code `wp_die()` was given; or `did not die` with what the
 *   function returned.
 */
function guide_dies(callable $call): array|string
{
    ob_start();
    try
    {
        $result = $call();
    }
    catch (Guide_Died $died)
    {
        return [
            'output' => ob_get_clean(),
            'message' => $died->getMessage(),
            'title' => $died->title,
            'response' => $died->args['response'] ?? null,
        ];
    }
    ob_end_clean();
    return 'did not die: ' . var_export($result, true);
}

/** Adds a user with a role and returns its ID: `grace` (an editor) unless told otherwise. */
function guide_user(string $login = 'grace', string $role = 'editor'): int
{
    return wp_insert_user([
        'user_login' => $login,
        'user_pass' => 'secret',
        'user_email' => "{$login}@example.org",
        'display_name' => ucfirst($login),
        'role' => $role,
        'user_registered' => '2026-03-01 09:00:00',
    ]);
}

/** Runs a function that prints and gives back what it printed, each run of whitespace collapsed to one space. */
function guide_render(callable $print): string
{
    ob_start();
    $print();
    return trim(preg_replace('/\s+/', ' ', ob_get_clean()));
}
