<?php
// Whether adding to the cache is suspended (wp_cache_add() does nothing then); given a value, sets it.
wp_suspend_cache_addition( true );
$added = wp_cache_add( 'k', 'v' );
wp_suspend_cache_addition( false );
return array( $added, wp_suspend_cache_addition() );
