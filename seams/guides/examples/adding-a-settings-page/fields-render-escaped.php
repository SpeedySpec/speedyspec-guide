<?php
// A section and a field: the field prints the stored value escaped, so quotes and tags in it can't break the form.
require_once ABSPATH . 'wp-admin/includes/template.php';

function my_plugin_render_greeting_section() {
	echo '<p>' . esc_html__( 'What the plugin says on admin screens.', 'my-plugin' ) . '</p>';
}

function my_plugin_render_greeting_field() {
	printf(
		'<input type="text" id="my_plugin_greeting" name="my_plugin_greeting" value="%s" class="regular-text" />',
		esc_attr( get_option( 'my_plugin_greeting', 'Hello' ) )
	);
}

function my_plugin_add_settings_fields() {
	add_settings_section( 'my_plugin_main', __( 'Greeting', 'my-plugin' ), 'my_plugin_render_greeting_section', 'my-plugin' );
	add_settings_field( 'my_plugin_greeting', __( 'Greeting text', 'my-plugin' ), 'my_plugin_render_greeting_field', 'my-plugin', 'my_plugin_main', array( 'label_for' => 'my_plugin_greeting' ) );
}
add_action( 'admin_init', 'my_plugin_add_settings_fields' );
my_plugin_add_settings_fields();

update_option( 'my_plugin_greeting', 'Say "hi" <b>loudly</b>' );
do_settings_sections( 'my-plugin' );
return null;
