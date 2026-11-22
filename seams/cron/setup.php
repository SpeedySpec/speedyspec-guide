<?php

declare(strict_types=1);

/**
 * Gives each Cron example a site whose options live in the object cache, so events can be scheduled without a
 *  database.
 *
 *  The options are siteurl and home `http://example.org`, and `cron` with no events (see `cached-options.php`).
 */

require __DIR__ . '/../basic-setup.php';
require __DIR__ . '/../cached-options.php';

defined('WP_CRON_LOCK_TIMEOUT') || define('WP_CRON_LOCK_TIMEOUT', MINUTE_IN_SECONDS);
$_SERVER['REQUEST_URI'] = '/';
$_SERVER['REQUEST_METHOD'] = 'GET';

guide_cached_options(['siteurl' => 'http://example.org', 'home' => 'http://example.org', 'cron' => ['version' => 2]]);

/** Prints the stored cron option, one event per line, so an example can show what it changed. */
function guide_crons(): void
{
    foreach (get_option('cron') as $timestamp => $hooks)
    {
        if ('version' === $timestamp)
        {
            continue;
        }
        foreach ($hooks as $hook => $events)
        {
            foreach ($events as $event)
            {
                echo $timestamp, ' ', $hook, ' ', json_encode($event), "\n";
            }
        }
    }
}
