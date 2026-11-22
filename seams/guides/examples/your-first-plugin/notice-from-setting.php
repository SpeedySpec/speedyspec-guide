<?php
// The whole plugin: the notice reads its text from the setting, and escapes it before printing.
update_option( 'my_first_plugin_greeting', 'Fish & chips' );
add_action( 'admin_notices', function () {
	$greeting = get_option( 'my_first_plugin_greeting', 'Hello from my first plugin!' );
	echo '<div class="notice notice-info"><p>' . esc_html( $greeting ) . '</p></div>';
} );
do_action( 'admin_notices' );
return null;
