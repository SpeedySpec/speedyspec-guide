<?php
// An activation hook runs once, when the plugin is activated: here it stores the plugin's default greeting.
function my_first_plugin_activate() {
	add_option( 'my_first_plugin_greeting', __( 'Hello from my first plugin!', 'my-first-plugin' ) );
}
$plugin_file = WP_PLUGIN_DIR . '/my-first-plugin/my-first-plugin.php';
register_activation_hook( $plugin_file, 'my_first_plugin_activate' );
// activate_plugin() fires this action after loading the plugin; firing it directly shows the hook's name.
$hook = 'activate_' . plugin_basename( $plugin_file );
do_action( $hook );
return array( $hook, get_option( 'my_first_plugin_greeting' ) );
