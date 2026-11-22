<?php
// Logs the current user out: their session ends, the cookies are cleared, the current user becomes nobody and wp_logout fires.
function guide_print_logged_out( $user_id ) {
	echo "logged out $user_id\n";
}
add_action( 'wp_logout', 'guide_print_logged_out' );
wp_logout();
return get_current_user_id();
