<?php
// The whole plugin: the notice reads its text from the setting, and escapes it before printing.
function my_first_plugin_notice() {
	$greeting = get_option( 'my_first_plugin_greeting', __( 'Hello from my first plugin!', 'my-first-plugin' ) );
	echo '<div class="notice notice-info"><p>' . esc_html( $greeting ) . '</p></div>';
}
add_action( 'admin_notices', 'my_first_plugin_notice' );
update_option( 'my_first_plugin_greeting', 'Fish & chips' );
do_action( 'admin_notices' );
return null;
