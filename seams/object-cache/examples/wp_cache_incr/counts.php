<?php
// Adds to a cached number and returns it; a key that isn't cached returns false.
wp_cache_set( 'n', 5 );
return array( wp_cache_incr( 'n' ), wp_cache_incr( 'n', 10 ), wp_cache_incr( 'missing' ) );
