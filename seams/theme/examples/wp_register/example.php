<?php
// Prints a register link for visitors when registration is open, or a Site Admin link for users; filtered by register.
$user = guide_render( 'wp_register' );
wp_set_current_user( 0 );
update_option( 'users_can_register', 1 );
return array( $user, guide_render( 'wp_register' ) );
