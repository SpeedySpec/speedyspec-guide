<?php
// Empties every group.
wp_cache_set( 'a', 1 );
wp_cache_set( 'b', 2, 'posts' );
return array( wp_cache_flush(), wp_cache_get( 'a' ), wp_cache_get( 'b', 'posts' ) );
