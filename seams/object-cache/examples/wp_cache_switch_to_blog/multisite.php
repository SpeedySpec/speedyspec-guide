<?php
// On multisite, each site sees its own keys outside the global groups.
wp_cache_set( 'k', 'site 1' );
wp_cache_switch_to_blog( 2 );
$on_2 = wp_cache_get( 'k' );
wp_cache_switch_to_blog( 1 );
return array( $on_2, wp_cache_get( 'k' ) );
