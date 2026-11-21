<?php
// The built-in cache lives only in memory, so this is wp_cache_flush().
wp_cache_set( 'a', 1 );
return array( wp_cache_flush_runtime(), wp_cache_get( 'a' ) );
