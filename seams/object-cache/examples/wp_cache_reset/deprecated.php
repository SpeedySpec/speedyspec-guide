<?php
// Deprecated since 3.5.0: empties every group but the global ones. WP_Object_Cache::reset() reports itself as reset.
add_action( 'deprecated_function_run', function ( $function_name, $replacement, $version ) {
	echo "$function_name $version ";
}, 10, 3 );
wp_cache_set( 'k', 'v' );
wp_cache_set( 'k', 'kept', 'users' );
wp_cache_reset();
return array( wp_cache_get( 'k' ), wp_cache_get( 'k', 'users' ) );
