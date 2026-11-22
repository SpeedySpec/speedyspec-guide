<?php
// Saving what a person typed: check the nonce and the capability, sanitize the value, then save it.
function my_first_plugin_save_greeting( array $submitted ) {
	if ( ! isset( $submitted['_wpnonce'] ) || ! wp_verify_nonce( $submitted['_wpnonce'], 'my_first_plugin_save' ) ) {
		return false;
	}
	if ( ! current_user_can( 'manage_options' ) || ! isset( $submitted['greeting'] ) ) {
		return false;
	}
	return update_option( 'my_first_plugin_greeting', sanitize_text_field( wp_unslash( $submitted['greeting'] ) ) );
}
// The form sends its nonce with the greeting (wp_nonce_field() prints it); here the submission is built by hand.
$nonce = wp_create_nonce( 'my_first_plugin_save' );
return array(
	'without a nonce' => my_first_plugin_save_greeting( array( 'greeting' => 'Hi' ) ),
	'saved'           => my_first_plugin_save_greeting( array( '_wpnonce' => $nonce, 'greeting' => ' Howdy, <b>partner</b>! ' ) ),
	'stored'          => get_option( 'my_first_plugin_greeting', 'Hello!' ),
);
