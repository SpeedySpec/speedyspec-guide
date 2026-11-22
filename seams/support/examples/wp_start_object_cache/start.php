<?php
// Starts the object cache: an object-cache.php drop-in when there is one, else WordPress's own, then the global groups; run again, it resets the cache.
wp_cache_set( 'k', 'v' );
wp_start_object_cache();
return array( wp_cache_get( 'k' ), wp_using_ext_object_cache() );
