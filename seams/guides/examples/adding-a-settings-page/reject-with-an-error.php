<?php
// A sanitize callback can refuse a value: keep the saved one, and add an error the settings screen shows.
require_once ABSPATH . 'wp-admin/includes/template.php'; // Holds the settings error functions.

function my_plugin_sanitize_greeting( $value ) {
	$value = sanitize_text_field( $value );
	if ( '' === $value ) {
		add_settings_error( 'my_plugin_greeting', 'my_plugin_empty_greeting', __( 'The greeting cannot be empty.', 'my-plugin' ) );
		return get_option( 'my_plugin_greeting' );
	}
	return $value;
}

function my_plugin_register_settings() {
	register_setting( 'my_plugin', 'my_plugin_greeting', array( 'type' => 'string', 'sanitize_callback' => 'my_plugin_sanitize_greeting', 'default' => 'Hello' ) );
}
my_plugin_register_settings();
update_option( 'my_plugin_greeting', 'Howdy' );

$saved  = update_option( 'my_plugin_greeting', '   <b></b>   ' );
$errors = get_settings_errors( 'my_plugin_greeting' );
return array(
	'saved'  => $saved,
	'stored' => get_option( 'my_plugin_greeting' ),
	'errors' => wp_list_pluck( $errors, 'message', 'code' ),
);
