<?php
// Removes every session of the logged-in user.
WP_Session_Tokens::get_instance( 1 )->create( time() + 3600 );
wp_destroy_all_sessions();
return wp_get_all_sessions();
