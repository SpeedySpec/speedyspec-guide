<?php
// A notice about your plugin's settings belongs on your plugin's screen, not on every admin screen.
require_once ABSPATH . 'wp-admin/includes/admin.php';

function my_plugin_saved_notice() {
	$screen = get_current_screen();
	if ( ! $screen || 'settings_page_my-plugin' !== $screen->id ) {
		return;
	}
	wp_admin_notice( esc_html__( 'Reading goal saved.', 'my-plugin' ), array( 'type' => 'success' ) );
}
add_action( 'admin_notices', 'my_plugin_saved_notice' );

function guide_notices_on( $screen_id ) {
	set_current_screen( $screen_id );
	ob_start();
	do_action( 'admin_notices' );
	return wp_strip_all_tags( ob_get_clean() );
}
return array(
	'the dashboard'     => guide_notices_on( 'dashboard' ),
	'the plugin screen' => trim( guide_notices_on( 'settings_page_my-plugin' ) ),
);
