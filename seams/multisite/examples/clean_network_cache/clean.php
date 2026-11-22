<?php
// Clears networks' caches and fires clean_network_cache.
add_action( 'clean_network_cache', fn( $id ) => print( "clean_network_cache $id\n" ) );
clean_network_cache( 1 );
return wp_cache_get( 1, 'networks' );
