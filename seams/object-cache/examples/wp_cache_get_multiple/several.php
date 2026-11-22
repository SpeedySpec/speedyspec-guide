<?php
// Reads several keys; a missing one is false.
wp_cache_set( 'a', 1 );
return wp_cache_get_multiple( array( 'a', 'b' ) );
