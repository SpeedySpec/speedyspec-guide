<?php
// The logged-in user's sessions, each with its expiry and login time; wp_destroy_other_sessions() keeps only the current one, wp_destroy_all_sessions() removes all.
$manager = WP_Session_Tokens::get_instance( 1 );
$manager->create( time() + 3600 );
$manager->create( time() + 3600 );
$count = count( wp_get_all_sessions() );
wp_destroy_all_sessions();
return array( $count, wp_get_all_sessions() );
