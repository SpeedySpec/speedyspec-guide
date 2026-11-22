<?php
// The current user's WP_User, worked out from the request on first use; an empty user when no one is logged in.
$admin = wp_get_current_user()->user_login;
wp_set_current_user( 0 );
return array( $admin, wp_get_current_user()->exists() );
