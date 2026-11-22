<?php
// The logged-in user's ID, or 0.
$admin = get_current_user_id();
wp_set_current_user( 0 );
return array( $admin, get_current_user_id() );
