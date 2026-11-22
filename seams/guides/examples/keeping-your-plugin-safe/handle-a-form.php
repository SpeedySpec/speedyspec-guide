<?php
// Putting it together: a form handler that checks the nonce and capability, validates, sanitizes, then saves.
function my_plugin_handle_signup( array $request ) {
	if ( ! isset( $request['_wpnonce'] ) || ! wp_verify_nonce( sanitize_key( $request['_wpnonce'] ), 'my_plugin_signup' ) ) {
		return 'refused: bad nonce';
	}
	if ( ! current_user_can( 'manage_options' ) ) {
		return 'refused: not allowed';
	}
	$email = isset( $request['email'] ) ? sanitize_email( wp_unslash( $request['email'] ) ) : '';
	if ( ! is_email( $email ) ) {
		return 'refused: invalid email';
	}
	update_option( 'my_plugin_signup_email', $email );
	return 'saved ' . get_option( 'my_plugin_signup_email' );
}
$nonce = wp_create_nonce( 'my_plugin_signup' );
$results = array(
	my_plugin_handle_signup( array( 'email' => 'ana@example.org' ) ),
	my_plugin_handle_signup( array( '_wpnonce' => $nonce, 'email' => 'nope' ) ),
	my_plugin_handle_signup( array( '_wpnonce' => $nonce, 'email' => ' ana@example.org ' ) ),
);
// A nonce belongs to the person it was made for: a subscriber's own nonce passes, but the capability check stops them.
$subscriber = wp_insert_user( array( 'user_login' => 'sam', 'user_pass' => wp_generate_password(), 'role' => 'subscriber' ) );
wp_set_current_user( $subscriber );
$results[] = my_plugin_handle_signup( array( '_wpnonce' => wp_create_nonce( 'my_plugin_signup' ), 'email' => 'ana@example.org' ) );
return $results;
