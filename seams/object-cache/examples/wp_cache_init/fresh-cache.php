<?php
// Replaces $wp_object_cache with a new, empty WP_Object_Cache.
wp_cache_set( 'k', 'v' );
wp_cache_init();
return array( get_class( $GLOBALS['wp_object_cache'] ), wp_cache_get( 'k' ) );
