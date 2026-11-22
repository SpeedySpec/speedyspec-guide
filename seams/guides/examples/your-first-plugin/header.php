<?php
// WordPress reads a plugin's name, version and description from the comment at the top of its main file.
$file = sys_get_temp_dir() . '/my-first-plugin.php';
file_put_contents( $file, <<<'PHP'
<?php
/**
 * Plugin Name:       My First Plugin
 * Description:       Says hello on every admin screen.
 * Version:           1.0.0
 * Requires at least: 6.5
 * Requires PHP:      7.4
 * Author:            A. Beginner
 * License:           GPL-2.0-or-later
 * Text Domain:       my-first-plugin
 */

// Stop if this file is opened directly, outside WordPress.
defined( 'ABSPATH' ) || exit;
PHP
);
require_once ABSPATH . 'wp-admin/includes/plugin.php';
$data = get_plugin_data( $file, false, false );
unlink( $file );
return array_intersect_key( $data, array_flip( array( 'Name', 'Version', 'RequiresWP', 'RequiresPHP', 'TextDomain' ) ) );
