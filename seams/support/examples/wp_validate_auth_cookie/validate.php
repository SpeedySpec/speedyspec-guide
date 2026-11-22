<?php
// The user ID a login cookie belongs to, when it is well formed, unexpired, its HMAC is right and its session exists; false otherwise, with auth_cookie_malformed, _expired, _bad_username, _bad_hash or _bad_session_token fired.
$expiration = time() + 3600;
$token = WP_Session_Tokens::get_instance( 1 )->create( $expiration );
$cookie = wp_generate_auth_cookie( 1, $expiration, 'auth', $token );
function guide_print_malformed() {
	echo "malformed\n";
}
add_action( 'auth_cookie_malformed', 'guide_print_malformed' );
return array( wp_validate_auth_cookie( $cookie, 'auth' ), wp_validate_auth_cookie( 'junk', 'auth' ) );
