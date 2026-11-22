<?php
// Clears a user's caches (by ID, login, email, nicename and meta); clean_user_cache fires.
get_userdata( 1 );
function guide_print_clean_user_cache( $user_id ) {
	echo "clean_user_cache $user_id\n";
}
add_action( 'clean_user_cache', 'guide_print_clean_user_cache' );
clean_user_cache( 1 );
return array( wp_cache_get( 1, 'users' ), wp_cache_get( 'admin', 'userlogins' ) );
