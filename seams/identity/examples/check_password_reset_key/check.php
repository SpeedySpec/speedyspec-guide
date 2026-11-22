<?php
// The user a reset key belongs to, or a WP_Error: invalid_key for a wrong or missing key, expired_key after a day (password_reset_expiration).
$key = get_password_reset_key( get_userdata( 1 ) );
function guide_expire_reset_keys_now( $expiration ) {
	return -1;
}
add_filter( 'password_reset_expiration', 'guide_expire_reset_keys_now' );
return array( check_password_reset_key( 'wrong', 'admin' )->get_error_code(), check_password_reset_key( $key, 'nobody' )->get_error_code(), check_password_reset_key( $key, 'admin' )->get_error_code() );
