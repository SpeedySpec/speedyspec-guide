<?php
// On a single site there is only one set of keys.
wp_cache_set( 'k', 'v' );
wp_cache_switch_to_blog( 2 );
return wp_cache_get( 'k' );
