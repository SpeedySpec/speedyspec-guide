<?php

declare(strict_types=1);

/**
 * Gives each Plugins example a site whose options live in the object cache (see `cached-options.php`), with a
 *  plugins folder of its own.
 *
 *  `WP_PLUGIN_DIR` is a fresh temporary folder, removed afterwards, holding these plugins: `shop/shop.php`
 *  (Shop, requires `payments`), `payments/payments.php` (Payments), `reports/reports.php` (Reports, requires
 *  `missing-plugin`), `ping/ping.php` and `pong/pong.php` (each requiring the other), and `hello.php`. `active_plugins`
 *  lists `payments/payments.php` and `shop/shop.php`. Plugin URLs are under `http://example.org/wp-content/plugins`.
 */

require __DIR__ . '/../basic-setup.php';
require __DIR__ . '/../cached-options.php';

// The real path, so the folder itself isn't seen as a symlink (macOS's temporary folder is behind one).
$guide_plugins = realpath(sys_get_temp_dir()) . '/guide-plugins-' . getmypid();
foreach ([
    'shop/shop.php' => ['Shop', 'payments'],
    'payments/payments.php' => ['Payments', ''],
    'reports/reports.php' => ['Reports', 'missing-plugin'],
    'ping/ping.php' => ['Ping', 'pong'],
    'pong/pong.php' => ['Pong', 'ping'],
    'hello.php' => ['Hello Dolly', ''],
] as $guide_file => [$guide_name, $guide_requires])
{
    @mkdir(dirname("$guide_plugins/$guide_file"), 0777, true);
    file_put_contents(
        "$guide_plugins/$guide_file",
        "<?php\n/**\n * Plugin Name: $guide_name\n * Version: 1.0\n"
            . ($guide_requires ? " * Requires Plugins: $guide_requires\n" : '')
            . " */\n"
    );
}
register_shutdown_function(static function () use ($guide_plugins): void
{
    exec('rm -rf ' . escapeshellarg($guide_plugins));
});

foreach ([
    'WP_CONTENT_DIR' => dirname($guide_plugins),
    'WP_PLUGIN_DIR' => $guide_plugins,
    'WPMU_PLUGIN_DIR' => $guide_plugins . '-mu',
    'WP_CONTENT_URL' => 'http://example.org/wp-content',
    'WP_PLUGIN_URL' => 'http://example.org/wp-content/plugins',
    'WPMU_PLUGIN_URL' => 'http://example.org/wp-content/mu-plugins',
] as $guide_name => $guide_value)
{
    defined($guide_name) || define($guide_name, $guide_value);
}
$GLOBALS['wp_plugin_paths'] = [];
$_SERVER['REQUEST_URI'] = '/';

guide_cached_options([
    'siteurl' => 'http://example.org',
    'home' => 'http://example.org',
    'cron' => ['version' => 2],
    'active_plugins' => ['payments/payments.php', 'shop/shop.php'],
]);
unset($guide_file, $guide_name, $guide_requires, $guide_value);
