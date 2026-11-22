<?php

declare(strict_types=1);

/**
 * Gives each Passwords and crypto example a freshly installed site, booted as WordPress boots (see `boot.php`), with the
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

