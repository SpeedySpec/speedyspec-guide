<?php
// Logs a user in from credentials (or the posted log and pwd): authenticates through authenticate, sets the auth cookies, fires wp_login, and returns the user or a WP_Error.
function guide_print_wp_login( $user_login ) {
	echo esc_html( "wp_login $user_login\n" );
}
add_action( 'wp_login', 'guide_print_wp_login' );
add_filter( 'send_auth_cookies', '__return_false' );
$ok = wp_signon( array( 'user_login' => 'admin', 'user_password' => 'password' ) );
$bad = wp_signon( array( 'user_login' => 'admin', 'user_password' => 'wrong' ) );
return array( $ok->user_login, $bad->get_error_code(), wp_signon( array( 'user_login' => 'nobody', 'user_password' => 'x' ) )->get_error_code() );
