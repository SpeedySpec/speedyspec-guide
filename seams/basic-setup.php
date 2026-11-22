<?php

declare(strict_types=1);

/**
 * The setup for seams whose examples need only WordPress's files: the constants `wp-config.php` and
 *  `default-constants.php` would define, and translation functions that return text unchanged.
 *
 *  `l10n.php` is not loaded, so `__()` and its kin return their text as given. With `GUIDE_MULTISITE` true,
 *  `MULTISITE` is defined. When the seam loads the object cache, a fresh one is started. With no database,
 *  `blog_charset` is supplied as `UTF-8`, so the escaping functions work.
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
    function _e($text, $domain = 'default')
    {
        echo $text;
    }
    function esc_html_e($text, $domain = 'default')
    {
        echo esc_html($text);
    }
    function esc_attr_e($text, $domain = 'default')
    {
        echo esc_attr($text);
    }
    function _nx($single, $plural, $number, $context, $domain = 'default')
    {
        return 1 === $number ? $single : $plural;
    }
    function _n_noop($singular, $plural, $domain = null)
    {
        return ['singular' => $singular, 'plural' => $plural, 'context' => null, 0 => $singular, 1 => $plural, 'domain' => $domain];
    }
    function _nx_noop($singular, $plural, $context, $domain = null)
    {
        return ['singular' => $singular, 'plural' => $plural, 'context' => $context, 0 => $singular, 1 => $plural, 2 => $context, 'domain' => $domain];
    }
    function wp_get_word_count_type()
    {
        return 'words';
    }
    function translate_nooped_plural($nooped_plural, $count, $domain = 'default')
    {
        return 1 === $count ? $nooped_plural['singular'] : $nooped_plural['plural'];
    }
}

// There is no database: the one option escaping reads, blog_charset, is supplied as an installed site stores it.
add_filter('pre_option_blog_charset', static fn () => 'UTF-8');

// wp-settings.php starts the object cache early; seams that load it get a fresh one.
if (function_exists('wp_cache_init'))
{
    wp_cache_init();
}

unset($guide_name, $guide_value);

/**
 * Calls a private or protected method, as WordPress calls it from inside the class, so an example can show it.
 *
 * @param object|string $target
 *   The object, or the class for a static method.
 * @return mixed
 *   What the method returns.
 */
function guide_call(object|string $target, string $method, mixed ...$args): mixed
{
    $class = is_object($target) ? $target::class : $target;
    return Closure::bind(
        fn () => is_object($target) ? $target->$method(...$args) : $class::$method(...$args),
        is_object($target) ? $target : null,
        $class
    )();
}
