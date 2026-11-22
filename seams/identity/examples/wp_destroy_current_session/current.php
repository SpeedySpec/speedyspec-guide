<?php
// Removes the current session, the one in the logged-in cookie.
$token = WP_Session_Tokens::get_instance( 1 )->create( time() + 3600 );
$_COOKIE[ LOGGED_IN_COOKIE ] = wp_generate_auth_cookie( 1, time() + 3600, 'logged_in', $token );
$before = count( wp_get_all_sessions() );
wp_destroy_current_session();
return array( $before, count( wp_get_all_sessions() ) );
