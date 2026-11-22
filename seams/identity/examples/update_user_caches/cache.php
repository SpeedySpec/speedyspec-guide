<?php
// Caches a user by ID, login, email and nicename.
$user = get_userdata( 1 )->data;
clean_user_cache( 1 );
update_user_caches( $user );
return array( wp_cache_get( 'admin', 'userlogins' ), wp_cache_get( 'admin@example.org', 'useremail' ), wp_cache_get( 'admin', 'userslugs' ) );
