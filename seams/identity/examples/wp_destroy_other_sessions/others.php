<?php
// Removes every session but the current one.
$token = WP_Session_Tokens::get_instance( 1 )->create( time() + 3600 );
WP_Session_Tokens::get_instance( 1 )->create( time() + 3600 );
$_COOKIE[ LOGGED_IN_COOKIE ] = wp_generate_auth_cookie( 1, time() + 3600, 'logged_in', $token );
wp_destroy_other_sessions();
return count( wp_get_all_sessions() );
