<?php
// A user by ID, as get_userdata() gives it; false when missing.
$grace = guide_user();
return array( get_user( $grace )->user_login, get_user( 999 ) );
