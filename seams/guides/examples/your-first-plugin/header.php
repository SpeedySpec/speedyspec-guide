<?php
// WordPress reads a plugin's name, version and description from the comment at the top of its main file.
$file = sys_get_temp_dir() . '/my-first-plugin.php';
file_put_contents( $file, <<<'PHP'
<?php
/**
 * Plugin Name: My First Plugin
 * Description: Says hello on every admin screen.
 * Version:     1.0.0
 * Author:      A. Beginner
 */
PHP
);
require_once ABSPATH . 'wp-admin/includes/plugin.php';
$data = get_plugin_data( $file, false, false );
unlink( $file );
return array_intersect_key( $data, array_flip( array( 'Name', 'Description', 'Version', 'Author' ) ) );
