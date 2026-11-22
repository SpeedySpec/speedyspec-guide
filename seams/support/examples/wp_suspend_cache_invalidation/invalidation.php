<?php
// Suspends clearing caches (clean_post_cache() and the like do nothing then), for imports, or resumes it with false; gives the old setting.
$was = wp_suspend_cache_invalidation( true );
$now = wp_suspend_cache_invalidation( false );
return array( $was, $now, $GLOBALS['_wp_suspend_cache_invalidation'] );
