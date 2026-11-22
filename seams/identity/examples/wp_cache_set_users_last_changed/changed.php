<?php
// Marks the users cache group changed, so cached user queries are stale.
$before = wp_cache_get_last_changed( 'users' );
wp_cache_set_users_last_changed();
return $before !== wp_cache_get_last_changed( 'users' );
