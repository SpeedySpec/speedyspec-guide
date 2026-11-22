<?php
// Logs a user in from credentials (or the posted log and pwd): authenticates through authenticate, sets the auth cookies, fires wp_login, and returns the user or a WP_Error.
add_action( 'wp_login', fn( $login ) => print( "wp_login $login\n" ) );
add_filter( 'send_auth_cookies', '__return_false' );
$ok = wp_signon( array( 'user_login' => 'admin', 'user_password' => 'password' ) );
$bad = wp_signon( array( 'user_login' => 'admin', 'user_password' => 'wrong' ) );
return array( $ok->user_login, $bad->get_error_code(), wp_signon( array( 'user_login' => 'nobody', 'user_password' => 'x' ) )->get_error_code() );
