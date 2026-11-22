<?php
// Adds wp-auth-check to a heartbeat response: whether the user is still logged in, and not on the interim login.
$logged = wp_auth_check( array() );
wp_set_current_user( 0 );
return array( $logged, wp_auth_check( array() ) );
