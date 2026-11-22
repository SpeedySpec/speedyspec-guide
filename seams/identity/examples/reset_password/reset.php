<?php
// Sets a user's new password, firing password_reset and after_password_reset.
$grace = guide_user();
add_action( 'after_password_reset', fn( $user ) => print( "after_password_reset {$user->user_login}\n" ) );
reset_password( get_userdata( $grace ), 'new-secret' );
return wp_check_password( 'new-secret', get_userdata( $grace )->user_pass, $grace );
