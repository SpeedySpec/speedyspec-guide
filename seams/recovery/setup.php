<?php

declare(strict_types=1);

/**
 * Gives each Recovery mode example a site whose options live in the object cache (see `cached-options.php`), with
 *  the constants `wp-config.php` and `default-constants.php` would define.
 *
 *  The options are siteurl and home `http://example.org`, blogname `Guide`, admin_email `admin@example.org`, and
 *  `cron` with no events. Plugins live in `/srv/site/wp-content/plugins`, and the request is for `/`.
 */

require __DIR__ . '/../basic-setup.php';
require __DIR__ . '/../cached-options.php';

foreach ([
    'AUTH_KEY' => 'guide auth key',
    'AUTH_SALT' => 'guide auth salt',
    'RECOVERY_MODE_COOKIE' => 'wordpress_rec_guide',
    'COOKIEPATH' => '/',
    'SITECOOKIEPATH' => '/',
    'COOKIE_DOMAIN' => '',
    'WP_PLUGIN_DIR' => '/srv/site/wp-content/plugins',
] as $guide_name => $guide_value)
{
    defined($guide_name) || define($guide_name, $guide_value);
}
$_SERVER['REQUEST_URI'] = '/';
$_SERVER['REQUEST_METHOD'] = 'GET';

guide_cached_options([
    'siteurl' => 'http://example.org',
    'home' => 'http://example.org',
    'blogname' => 'Guide',
    'admin_email' => 'admin@example.org',
    'cron' => ['version' => 2],
]);
