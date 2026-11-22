<?php
// Logs the current user out: their session ends, the cookies are cleared, the current user becomes nobody and wp_logout fires.
add_action( 'wp_logout', fn( $id ) => print( "logged out $id\n" ) );
wp_logout();
return get_current_user_id();
