<?php
// Validating asks "is this what I expect?" and refuses anything else, instead of quietly changing it.
function my_plugin_validate_signup( $email, $seats ) {
	if ( ! is_email( $email ) ) {
		return new WP_Error( 'my_plugin_bad_email', __( 'Enter a valid email address.', 'my-plugin' ) );
	}
	if ( ! is_numeric( $seats ) || (int) $seats < 1 || (int) $seats > 10 ) {
		return new WP_Error( 'my_plugin_bad_seats', __( 'Choose between 1 and 10 seats.', 'my-plugin' ) );
	}
	return array( 'email' => $email, 'seats' => absint( $seats ) );
}
$results = array();
foreach ( array( array( 'ana@example.org', '2' ), array( 'not an email', '2' ), array( 'ana@example.org', '-5' ) ) as $input ) {
	$checked   = my_plugin_validate_signup( $input[0], $input[1] );
	$results[] = is_wp_error( $checked ) ? $checked->get_error_code() : $checked;
}
return $results;
