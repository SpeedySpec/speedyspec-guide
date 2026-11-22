<?php
// Creates the sitemaps server once, initializes it and fires wp_sitemaps_init with it.
function guide_print_server_class( $wp_sitemaps ) {
	print( get_class( $wp_sitemaps ) . "\n" );
}
add_action( 'wp_sitemaps_init', 'guide_print_server_class' );
$server = wp_sitemaps_get_server();
return array( $server === wp_sitemaps_get_server(), $server === $GLOBALS['wp_sitemaps'], array_keys( $server->registry->get_providers() ) );
