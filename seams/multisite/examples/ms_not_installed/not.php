<?php
// Stops the request with an error page saying the database connection failed, because the network's tables or its site for this domain and path are missing.
function guide_throw_die_title( $message, $title = '' ) {
	throw new RuntimeException( $title );
}
function guide_die_handler( $handler ) {
	return 'guide_throw_die_title';
}
add_filter( 'wp_die_handler', 'guide_die_handler' );
try { ms_not_installed( 'example.org', '/' ); } catch ( RuntimeException $e ) { return $e->getMessage(); }
