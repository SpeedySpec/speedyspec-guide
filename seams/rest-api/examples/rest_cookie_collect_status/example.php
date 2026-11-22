<?php
// Hooked to the auth_cookie_* actions: notes in $wp_rest_auth_cookie whether the cookie authenticated the request (true) or why not, such as bad_hash.
global $wp_rest_auth_cookie;
foreach ( array( 'auth_cookie_bad_hash', 'auth_cookie_valid' ) as $action ) {
	add_action( $action, 'rest_cookie_collect_status' );
}
do_action( 'auth_cookie_bad_hash' );
$bad = $wp_rest_auth_cookie;
do_action( 'auth_cookie_valid' );
return array( $bad, $wp_rest_auth_cookie );
