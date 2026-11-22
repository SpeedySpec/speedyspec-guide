<?php
// Clears a user's caches (by ID, login, email, nicename and meta); clean_user_cache fires.
get_userdata( 1 );
add_action( 'clean_user_cache', fn( $id ) => print( "clean_user_cache $id\n" ) );
clean_user_cache( 1 );
return array( wp_cache_get( 1, 'users' ), wp_cache_get( 'admin', 'userlogins' ) );
