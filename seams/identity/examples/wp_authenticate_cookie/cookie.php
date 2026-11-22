<?php
// On authenticate with no credentials: the user from a valid auth cookie; an expired or bad cookie is a WP_Error.
$token = WP_Session_Tokens::get_instance( 1 )->create( time() + 3600 );
$_COOKIE[ AUTH_COOKIE ] = wp_generate_auth_cookie( 1, time() + 3600, 'auth', $token );
$from_cookie = wp_authenticate_cookie( null, '', '' );
$_COOKIE[ AUTH_COOKIE ] = 'admin|1|bad|bad';
return array( $from_cookie->ID, wp_authenticate_cookie( null, '', '' )->get_error_code() );
