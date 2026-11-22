<?php
// Clears networks' caches and fires clean_network_cache.
function guide_print_clean_network_cache( $id ) {
	echo "clean_network_cache $id\n";
}
add_action( 'clean_network_cache', 'guide_print_clean_network_cache' );
clean_network_cache( 1 );
return wp_cache_get( 1, 'networks' );
