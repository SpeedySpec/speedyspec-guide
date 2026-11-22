<?php
// The logged-in user, determined once through determine_current_user; a WP_User with ID 0 when nobody is.
$admin = _wp_get_current_user()->user_login;
wp_set_current_user( 0 );
return array( $admin, _wp_get_current_user()->ID );
