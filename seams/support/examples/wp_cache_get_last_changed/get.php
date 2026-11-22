<?php
// The last time a cache group changed, as microtime; set to now when it was never set.
$time = wp_cache_get_last_changed( 'guide' );
return $time === wp_cache_get_last_changed( 'guide' );
