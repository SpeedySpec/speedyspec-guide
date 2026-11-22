<?php
// On multisite, a global group's keys are shared by every site.
wp_cache_add_global_groups( 'guide' );
wp_cache_set( 'k', 'site 1', 'guide' );
wp_cache_set( 'k', 'site 1 only', 'posts' );
wp_cache_switch_to_blog( 2 );
return array( wp_cache_get( 'k', 'guide' ), wp_cache_get( 'k', 'posts' ) );
