<?php

declare(strict_types=1);

/**
 * Gives each Object Cache example a fresh WordPress object cache, after the seam's `wordpress` files are loaded.
 *
 *  It starts the cache as `wp-settings.php` does, with `wp_start_object_cache()`'s global groups. With
 *  `GUIDE_MULTISITE` true it is a multisite install on site 1, so keys outside the global groups are prefixed with
 *  the site id.
 */

foreach (['WP_DEBUG' => false, 'KB_IN_BYTES' => 1024] as $guide_name => $guide_value)
{
    defined($guide_name) || define($guide_name, $guide_value);
}
if (GUIDE_MULTISITE)
{
    define('MULTISITE', true);
}

// l10n.php is not loaded: text comes back untranslated.
if (!function_exists('__'))
{
    function __($text, $domain = 'default')
    {
        return $text;
    }
}

$GLOBALS['blog_id'] = 1;
wp_cache_init();
wp_cache_add_global_groups(
    ['blog-details', 'blog-id-cache', 'blog-lookup', 'blog_meta', 'global-posts', 'image_editor', 'networks',
        'network-queries', 'sites', 'site-details', 'site-options', 'site-queries', 'site-transient', 'theme_files',
        'translation_files', 'rss', 'users', 'user-queries', 'user_meta', 'useremail', 'userlogins', 'userslugs']
);

unset($guide_name, $guide_value);
