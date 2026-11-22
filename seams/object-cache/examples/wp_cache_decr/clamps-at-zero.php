<?php
// Subtracts from a cached number, never going below 0.
wp_cache_set( 'n', 2 );
return array( wp_cache_decr( 'n' ), wp_cache_decr( 'n', 5 ) );
