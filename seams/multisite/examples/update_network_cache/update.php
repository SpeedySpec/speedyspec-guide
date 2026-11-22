<?php
// Puts networks into the cache.
$network = get_network( 1 );
wp_cache_delete( 1, 'networks' );
update_network_cache( array( $network ) );
return wp_cache_get( 1, 'networks' )->domain;
