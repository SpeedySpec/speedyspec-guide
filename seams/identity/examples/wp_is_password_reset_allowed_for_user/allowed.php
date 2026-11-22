<?php
// Whether a user may reset their password: not spam on a network, and allow_password_reset says yes.
$grace = guide_user();
add_filter( 'allow_password_reset', fn( $ok, $id ) => 1 === $id, 10, 2 );
return array( wp_is_password_reset_allowed_for_user( get_userdata( 1 ) ), wp_is_password_reset_allowed_for_user( get_userdata( $grace ) ), wp_is_password_reset_allowed_for_user( 1 ) );
