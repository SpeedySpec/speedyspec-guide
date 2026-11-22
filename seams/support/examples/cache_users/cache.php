<?php
// Loads users and their meta into the cache, those not cached yet, in two queries.
$grace = guide_user();
wp_cache_delete( $grace, 'users' );
cache_users( array( $grace ) );
return wp_cache_get( $grace, 'users' )->user_login;
