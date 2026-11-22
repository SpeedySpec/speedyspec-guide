<?php
// Load your admin assets only on your own screen: admin_enqueue_scripts passes the screen's hook suffix.
function my_plugin_enqueue_admin_assets( $hook_suffix ) {
	if ( 'settings_page_my-plugin' !== $hook_suffix ) { // add_options_page( …, 'my-plugin', … ) names it this.
		return;
	}
	$plugin_file = WP_PLUGIN_DIR . '/my-plugin/my-plugin.php'; // __FILE__ in the plugin's main file.
	wp_enqueue_style( 'my-plugin-admin', plugins_url( 'css/admin.css', $plugin_file ), array(), '1.2.0' );
	wp_enqueue_script( 'my-plugin-admin', plugins_url( 'js/admin.js', $plugin_file ), array(), '1.2.0', array( 'in_footer' => true ) );
}
add_action( 'admin_enqueue_scripts', 'my_plugin_enqueue_admin_assets' );

do_action( 'admin_enqueue_scripts', 'edit.php' );
$on_posts_screen = wp_script_is( 'my-plugin-admin', 'enqueued' );
do_action( 'admin_enqueue_scripts', 'settings_page_my-plugin' );
return array(
	'on the posts screen'    => $on_posts_screen,
	'on its settings screen' => wp_script_is( 'my-plugin-admin', 'enqueued' ) && wp_style_is( 'my-plugin-admin', 'enqueued' ),
);
