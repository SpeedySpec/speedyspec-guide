<?php
// Hooked to rest_authentication_errors: a cookie-authenticated request needs a valid wp_rest nonce, else the user is logged out for it; an invalid nonce is a 403 error.
global $wp_rest_auth_cookie;
$wp_rest_auth_cookie = true;
$_REQUEST['_wpnonce'] = 'bad';
$bad = rest_cookie_check_errors( null );
$_REQUEST['_wpnonce'] = wp_create_nonce( 'wp_rest' );
return array( $bad->get_error_code(), rest_cookie_check_errors( null ) );
