<?php
// The built-in cache keeps nothing between requests, so this changes nothing.
wp_cache_add_non_persistent_groups( 'guide' );
wp_cache_set( 'k', 'v', 'guide' );
return wp_cache_get( 'k', 'guide' );
