<?php
// Lets only logged-in users through: with a valid login cookie it fires auth_redirect and returns; without one, it redirects to the login page with the address to return to (reauth=1) and ends the request.
$expiration = time() + 3600;
$_COOKIE[ AUTH_COOKIE ] = wp_generate_auth_cookie( 1, $expiration, 'auth', WP_Session_Tokens::get_instance( 1 )->create( $expiration ) );
function guide_print_auth_redirect( $user_id ) {
	echo "auth_redirect for user $user_id\n";
}
add_action( 'auth_redirect', 'guide_print_auth_redirect' );
auth_redirect();
return 'let through';
