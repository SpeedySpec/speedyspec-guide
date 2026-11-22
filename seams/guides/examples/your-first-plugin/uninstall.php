<?php
// A plugin's uninstall.php removes what the plugin stored; WordPress defines WP_UNINSTALL_PLUGIN before loading it.
add_option( 'my_first_plugin_greeting', 'Howdy!' );
define( 'WP_UNINSTALL_PLUGIN', 'my-first-plugin/my-first-plugin.php' );
// The file starts with this guard, so it does nothing when opened any other way.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}
delete_option( 'my_first_plugin_greeting' );
return get_option( 'my_first_plugin_greeting', 'gone' );
