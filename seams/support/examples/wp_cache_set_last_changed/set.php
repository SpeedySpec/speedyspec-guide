<?php
// Marks a cache group as changed now, firing wp_cache_set_last_changed with the old time.
add_action( 'wp_cache_set_last_changed', fn( $group ) => print( "$group changed\n" ) );
$old = wp_cache_get_last_changed( 'guide' );
return wp_cache_set_last_changed( 'guide' ) !== $old;
