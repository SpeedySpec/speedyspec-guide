<?php
// Sets the old current-user globals (user_login, userdata, user_level, user_ID, user_email, user_url, user_identity) for a user.
setup_userdata( 1 );
global $user_login, $user_ID, $user_email, $user_identity, $user_level;
return array( $user_login, $user_ID, $user_email, $user_identity, $user_level );
