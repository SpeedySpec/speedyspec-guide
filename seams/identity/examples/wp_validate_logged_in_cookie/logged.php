<?php
// On determine_current_user: the user ID from a valid logged-in cookie, outside the admin and API; false without one.
$token = WP_Session_Tokens::get_instance( 1 )->create( time() + 3600 );
$_COOKIE[ LOGGED_IN_COOKIE ] = wp_generate_auth_cookie( 1, time() + 3600, 'logged_in', $token );
$valid = wp_validate_logged_in_cookie( false );
unset( $_COOKIE[ LOGGED_IN_COOKIE ] );
return array( $valid, wp_validate_logged_in_cookie( false ), wp_validate_logged_in_cookie( 7 ) );
