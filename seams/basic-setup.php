<?php

declare(strict_types=1);

/**
 * The setup for seams whose examples need only WordPress's files: the constants `wp-config.php` and
 *  `default-constants.php` would define, and translation functions that return text unchanged.
 *
 *  `l10n.php` is not loaded, so `__()` and its kin return their text as given. With `GUIDE_MULTISITE` true,
 *  `MULTISITE` is defined. When the seam loads the object cache, a fresh one is started.
 */

foreach ([
    'WP_DEBUG' => false,
    'WP_DEBUG_DISPLAY' => false,
    'KB_IN_BYTES' => 1024,
    'MINUTE_IN_SECONDS' => 60,
    'HOUR_IN_SECONDS' => 3600,
    'DAY_IN_SECONDS' => 86400,
    'WEEK_IN_SECONDS' => 604800,
    'MONTH_IN_SECONDS' => 2592000,
    'YEAR_IN_SECONDS' => 31536000,
] as $guide_name => $guide_value)
{
    defined($guide_name) || define($guide_name, $guide_value);
}
if (GUIDE_MULTISITE)
{
    define('MULTISITE', true);
}

if (!function_exists('__'))
{
    function __($text, $domain = 'default')
    {
        return $text;
    }

    function _x($text, $context, $domain = 'default')
    {
        return $text;
    }

    function _n($single, $plural, $number, $domain = 'default')
    {
        return 1 === $number ? $single : $plural;
    }

    function esc_html__($text, $domain = 'default')
    {
        return esc_html($text);
    }

    function esc_attr__($text, $domain = 'default')
    {
        return esc_attr($text);
    }
}

// wp-settings.php starts the object cache early; seams that load it get a fresh one.
if (function_exists('wp_cache_init'))
{
    wp_cache_init();
}

unset($guide_name, $guide_value);
