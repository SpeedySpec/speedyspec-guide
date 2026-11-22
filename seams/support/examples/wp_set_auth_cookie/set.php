<?php
// Logs a user in by setting the login cookies (auth or secure_auth, and logged_in), for two days or 14 when remembered, with a new session; set_auth_cookie and set_logged_in_cookie fire, and send_auth_cookies can stop the sending.
add_filter( 'send_auth_cookies', '__return_false' );
add_action( 'set_logged_in_cookie', fn( $cookie, $expire, $expiration, $user_id, $scheme ) => print( "$scheme cookie for user $user_id, " . ( $expiration - time() > 13 * DAY_IN_SECONDS ? '14 days' : 'short' ) . "\n" ), 10, 5 );
wp_set_auth_cookie( 1, true );
return count( WP_Session_Tokens::get_instance( 1 )->get_all() );
