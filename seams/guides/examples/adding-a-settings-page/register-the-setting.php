<?php
// Register the setting with its type, default and sanitize callback, so WordPress knows how to save it.
function my_plugin_sanitize_greeting( $value ) {
	return sanitize_text_field( $value );
}

function my_plugin_register_settings() {
	register_setting(
		'my_plugin',
		'my_plugin_greeting',
		array(
			'type'              => 'string',
			'description'       => __( 'The greeting shown on admin screens.', 'my-plugin' ),
			'sanitize_callback' => 'my_plugin_sanitize_greeting',
			'default'           => __( 'Hello', 'my-plugin' ),
			'show_in_rest'      => false,
		)
	);
}
add_action( 'admin_init', 'my_plugin_register_settings' );

// WordPress fires admin_init on every admin screen; the example calls the function directly instead.
my_plugin_register_settings();
$setting = get_registered_settings()['my_plugin_greeting'];
return array(
	'group'             => $setting['group'],
	'type'              => $setting['type'],
	'sanitize callback' => $setting['sanitize_callback'],
	'default'           => $setting['default'],
	'read before saving' => get_option( 'my_plugin_greeting' ),
);
