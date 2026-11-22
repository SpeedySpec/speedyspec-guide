<?php
// Checks a login (or email) and password through the authenticate filter: a WP_User, or a WP_Error saying what was wrong.
$user = wp_authenticate( 'admin', 'password' );
$wrong = wp_authenticate( 'admin', 'nope' );
$empty = wp_authenticate( '', '' );
return array( $user->ID, $wrong->get_error_code(), $empty->get_error_codes() );
