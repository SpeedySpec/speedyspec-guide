<?php
// Empties one group and leaves the others.
wp_cache_set( 'k', 1, 'posts' );
wp_cache_set( 'k', 2, 'terms' );
wp_cache_flush_group( 'posts' );
return array( wp_cache_get( 'k', 'posts' ), wp_cache_get( 'k', 'terms' ) );
