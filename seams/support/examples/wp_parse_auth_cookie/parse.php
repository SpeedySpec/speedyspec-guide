<?php
// A login cookie's parts (username, expiration, token, hmac, scheme), from the value or the request's cookie of a scheme; false when malformed.
$cookie = wp_generate_auth_cookie( 1, 2000000000, 'auth', 'tok' );
$parts = wp_parse_auth_cookie( $cookie, 'auth' );
unset( $parts['hmac'] );
return array( $parts, wp_parse_auth_cookie( 'a|b', 'auth' ) );
