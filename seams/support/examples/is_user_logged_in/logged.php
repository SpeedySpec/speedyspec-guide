<?php
// Whether a user is logged in: the current user exists.
$in = is_user_logged_in();
wp_set_current_user( 0 );
return array( $in, is_user_logged_in() );
