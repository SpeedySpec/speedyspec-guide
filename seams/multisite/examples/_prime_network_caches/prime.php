<?php
// Loads networks into the cache, those not cached yet.
wp_cache_delete( 1, 'networks' );
_prime_network_caches( array( 1 ) );
return wp_cache_get( 1, 'networks' )->domain;
