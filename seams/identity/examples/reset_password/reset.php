<?php
// Sets a user's new password, firing password_reset and after_password_reset.
$grace = guide_user();
function guide_print_after_password_reset( $user ) {
	echo "after_password_reset {$user->user_login}\n";
}
add_action( 'after_password_reset', 'guide_print_after_password_reset' );
reset_password( get_userdata( $grace ), 'new-secret' );
return wp_check_password( 'new-secret', get_userdata( $grace )->user_pass, $grace );
