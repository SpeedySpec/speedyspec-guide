<?php
// Updates a user's fields (hashing a new password and logging out other sessions), keeping the rest; a changed email or password sends a notice. profile_update fires.
$grace = guide_user();
add_action( 'profile_update', fn( $id ) => print( "profile_update\n" ) );
$id = wp_update_user( array( 'ID' => $grace, 'display_name' => 'Grace Hopper', 'user_email' => 'hopper@example.org' ) );
return array( $id === $grace, get_userdata( $grace )->display_name, get_userdata( $grace )->user_email, wp_update_user( array( 'ID' => 999 ) )->get_error_code() );
