<?php
// Checks a request's confirmation key: missing, expired (after a day, user_request_key_expiration) or wrong keys and requests not pending are WP_Errors.
$request = wp_create_user_request( 'admin@example.org', 'export_personal_data' );
$key = wp_generate_user_request_key( $request );
function guide_expire_request_keys_now( $expiration ) {
	return -1;
}
add_filter( 'user_request_key_expiration', 'guide_expire_request_keys_now' );
return array( wp_validate_user_request_key( $request, $key )->get_error_code(), wp_validate_user_request_key( $request, '' )->get_error_code(), wp_validate_user_request_key( 999, 'x' )->get_error_code() );
