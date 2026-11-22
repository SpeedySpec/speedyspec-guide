<?php
// Makes a user the current user by ID or login, sets up its globals and fires set_current_user; given the current user, nothing changes.
$grace = guide_user();
function guide_print_set_current_user() {
	echo "set_current_user\n";
}
add_action( 'set_current_user', 'guide_print_set_current_user' );
$user = wp_set_current_user( $grace );
return array( $user->user_login, get_current_user_id() === $grace, wp_set_current_user( 0, 'admin' )->ID );
