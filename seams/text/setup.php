<?php

declare(strict_types=1);

/**
 * The shared basic setup, plus what the Text seam's functions read from an installed site.
 *
 *  The seam loads `default-filters.php`, so the examples run with WordPress's default hooks: among them, kses
 *  filters through the HTML API (`wp_kses_force_legacy_parser` returns false), and `sanitize_title` runs
 *  `sanitize_title_with_dashes()`. With no database, the site's `home` and `siteurl` are `http://example.org`; with
 *  `l10n.php` not loaded, `get_locale()` is `en_US` and `wp_get_word_count_type()` counts words.
 */

require __DIR__ . '/../basic-setup.php';

add_filter('pre_option_home', static fn () => 'http://example.org');
add_filter('pre_option_siteurl', static fn () => 'http://example.org');

// l10n.php is not loaded: a stand-in get_locale() gives the locale of a site in English, as the translation stubs do.
if (!function_exists('get_locale'))
{
    function get_locale()
    {
        return 'en_US';
    }
}
// l10n.php's word count type, for a locale that counts words.
if (!function_exists('wp_get_word_count_type'))
{
    function wp_get_word_count_type()
    {
        return 'words';
    }
}
