<?php
// Adds several values; each result says whether that key was added.
wp_cache_set( 'b', 'old' );
return wp_cache_add_multiple( array( 'a' => 1, 'b' => 2 ) );
