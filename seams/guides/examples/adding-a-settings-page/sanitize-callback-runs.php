<?php
// Once registered, the sanitize callback runs on every save of the option, wherever the save comes from.
function my_plugin_sanitize_greeting( $value ) {
	return sanitize_text_field( $value );
}

function my_plugin_register_settings() {
	register_setting( 'my_plugin', 'my_plugin_greeting', array( 'type' => 'string', 'sanitize_callback' => 'my_plugin_sanitize_greeting', 'default' => 'Hello' ) );
}
my_plugin_register_settings();

update_option( 'my_plugin_greeting', "  Howdy <script>alert(1)</script><em>there</em>\n" );
return get_option( 'my_plugin_greeting' );
