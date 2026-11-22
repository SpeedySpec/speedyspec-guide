<?php

declare(strict_types=1);

/**
 * Gives each Users and roles example a freshly installed site, booted as WordPress boots (see `boot.php`), with the
 *  administrator `admin` (user 1, password `password`) logged in. Emails are shown instead of sent, and deprecation
 *  and doing-it-wrong notices are reported to the example instead of raised as errors.
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
unset($guide_kind);

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
