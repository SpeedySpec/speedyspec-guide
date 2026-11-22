<?php
// Creates the sitemaps server once, initializes it and fires wp_sitemaps_init with it.
add_action( 'wp_sitemaps_init', fn( $s ) => print( get_class( $s ) . "\n" ) );
$server = wp_sitemaps_get_server();
return array( $server === wp_sitemaps_get_server(), $server === $GLOBALS['wp_sitemaps'], array_keys( $server->registry->get_providers() ) );
