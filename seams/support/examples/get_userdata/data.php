<?php
// A user's WP_User by ID, or false.
return array( get_userdata( 1 )->user_login, get_userdata( 999 ) );
