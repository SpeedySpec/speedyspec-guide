<?php
// An object is cloned when stored and when read, so changing it later doesn't change the cache.
$o = (object) array( 'n' => 1 );
wp_cache_set( 'k', $o );
$o->n = 2;
return wp_cache_get( 'k' )->n;
