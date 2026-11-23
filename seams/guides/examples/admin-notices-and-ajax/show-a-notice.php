<?php
// Print a notice on admin_notices with wp_admin_notice(): a type, a message it escapes as you ask, and whether it can be dismissed.
require_once ABSPATH . 'wp-admin/includes/admin.php'; // Loaded on every admin screen; the example loads it itself.

function my_plugin_missing_key_notice() {
	if ( ! current_user_can( 'manage_options' ) || get_option( 'my_plugin_api_key' ) ) {
		return;
	}
	wp_admin_notice(
		sprintf(
			/* translators: %s: Link to the settings screen. */
			esc_html__( 'My Plugin needs an API key. %s', 'my-plugin' ),
			'<a href="' . esc_url( admin_url( 'options-general.php?page=my-plugin' ) ) . '">' . esc_html__( 'Add one', 'my-plugin' ) . '</a>'
		),
		array( 'type' => 'warning', 'dismissible' => true, 'id' => 'my-plugin-missing-key' )
	);
}
add_action( 'admin_notices', 'my_plugin_missing_key_notice' );

set_current_screen( 'dashboard' );
ob_start();
do_action( 'admin_notices' ); // What every admin screen does below its title.
$notice = ob_get_clean();
update_option( 'my_plugin_api_key', 'set' );
ob_start();
do_action( 'admin_notices' );
return array( 'without a key' => trim( $notice ), 'with a key' => ob_get_clean() );
