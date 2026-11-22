<?php
// Fills PHP_AUTH_USER and PHP_AUTH_PW from a Basic Authorization header when the server didn't.
$_SERVER['HTTP_AUTHORIZATION'] = 'Basic ' . base64_encode( 'ada:secret' );
unset( $_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW'] );
wp_populate_basic_auth_from_authorization_header();
return array( $_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW'] );
