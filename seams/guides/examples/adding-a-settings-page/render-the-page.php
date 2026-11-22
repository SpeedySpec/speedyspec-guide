<?php
// The page itself: check the capability, then print a form that posts to options.php with the group's fields.
require_once ABSPATH . 'wp-admin/includes/plugin.php';
require_once ABSPATH . 'wp-admin/includes/template.php';

function my_plugin_render_settings_page() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}
	echo '<div class="wrap"><h1>' . esc_html__( 'My Plugin settings', 'my-plugin' ) . '</h1>';
	echo '<form action="' . esc_url( admin_url( 'options.php' ) ) . '" method="post">';
	settings_fields( 'my_plugin' );       // The group's name, and a nonce for it.
	do_settings_sections( 'my-plugin' ); // Every section and field added to the page (none in this example).
	submit_button();
	echo '</form></div>';
}

ob_start();
my_plugin_render_settings_page();
$html = ob_get_clean();
// The nonce changes over time, so the example hides its value.
$html = preg_replace( '/(name="_wpnonce" value=")[0-9a-f]+/', '$1…', $html );
wp_set_current_user( 0 );
ob_start();
my_plugin_render_settings_page();
return array( 'administrator' => $html, 'logged out' => ob_get_clean() );
