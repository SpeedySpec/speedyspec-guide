<?php
// Sets a user's password straight in the database, hashed, and clears the activation key and the user's cache; it logs them out of their sessions; wp_set_password fires.
$grace = guide_user();
add_action( 'wp_set_password', fn( $password, $id ) => print( "password set for $id\n" ), 10, 2 );
wp_set_password( 'newpass', $grace );
return wp_check_password( 'newpass', get_userdata( $grace )->user_pass );
