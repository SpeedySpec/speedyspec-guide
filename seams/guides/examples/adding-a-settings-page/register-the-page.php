<?php
// Add the page under Settings on admin_menu, for people who can manage options.
require_once ABSPATH . 'wp-admin/includes/plugin.php'; // Loaded on every admin screen; examples load it themselves.

function my_plugin_add_settings_page() {
	add_options_page(
		__( 'My Plugin settings', 'my-plugin' ),
		__( 'My Plugin', 'my-plugin' ),
		'manage_options',
		'my-plugin',
		'my_plugin_render_settings_page'
	);
}
add_action( 'admin_menu', 'my_plugin_add_settings_page' );

do_action( 'admin_menu' );
foreach ( $GLOBALS['submenu']['options-general.php'] as $item ) {
	if ( 'my-plugin' === $item[2] ) {
		return array( 'menu title' => $item[0], 'capability' => $item[1], 'slug' => $item[2], 'page title' => $item[3] );
	}
}
return 'not registered';
