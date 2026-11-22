<?php
// A plugin's first hook: a named, prefixed function added to admin_notices runs when WordPress fires that action.
function my_first_plugin_notice() {
	echo '<div class="notice notice-info"><p>' . esc_html__( 'Hello from my first plugin!', 'my-first-plugin' ) . '</p></div>';
}
add_action( 'admin_notices', 'my_first_plugin_notice' );
ob_start();
do_action( 'admin_notices' );
return ob_get_clean();
