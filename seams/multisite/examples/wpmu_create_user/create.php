<?php
// Creates a network user without a role on any site (their capabilities and level are removed); fires wpmu_new_user. False when the user can't be made.
add_action( 'wpmu_new_user', fn( $id ) => print( "wpmu_new_user\n" ) );
$id = wpmu_create_user( 'grace', 'secret', 'grace@example.org' );
return array( get_userdata( $id )->roles, wpmu_create_user( 'grace', 'x', 'grace@example.org' ) );
