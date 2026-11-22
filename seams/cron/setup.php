<?php

declare(strict_types=1);

/**
 * Gives each Cron example a site whose options live in the object cache, so events can be scheduled without a
 *  database.
 *
 *  The options are the cached `alloptions` an installed site autoloads: siteurl and home `http://example.org`, and
 *  `cron` with no events. `update_option()` writes them back to that cache; `$wpdb` stands in only to report each
 *  write as saved. Transients live in the object cache, as on a site with a persistent cache.
 */

require __DIR__ . '/../basic-setup.php';

defined('WP_CRON_LOCK_TIMEOUT') || define('WP_CRON_LOCK_TIMEOUT', MINUTE_IN_SECONDS);
$_SERVER['REQUEST_URI'] = '/';
$_SERVER['REQUEST_METHOD'] = 'GET';

/** The database as the option writes see it: every write succeeds, and there is nothing to read. */
final class Guide_Saving_Wpdb
{
    public $options = 'wp_options';

    public function prepare($query, ...$args)
    {
        return $query;
    }

    public function update($table, $data, $where)
    {
        return 1;
    }

    public function get_var($query = null)
    {
        return null;
    }

    public function get_results($query = null, $output = null)
    {
        return [];
    }

    public function strip_invalid_text_for_column($table, $column, $value)
    {
        return $value;
    }
}
$GLOBALS['wpdb'] = new Guide_Saving_Wpdb();

wp_using_ext_object_cache(true);
wp_cache_set(
    'alloptions',
    ['siteurl' => 'http://example.org', 'home' => 'http://example.org', 'cron' => serialize(['version' => 2])],
    'options'
);

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
