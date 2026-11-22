<?php
// Stops the request with an error page saying the database connection failed, because the network's tables or its site for this domain and path are missing.
add_filter( 'wp_die_handler', fn() => function ( $message, $title = '' ) { throw new RuntimeException( $title ); } );
try { ms_not_installed( 'example.org', '/' ); } catch ( RuntimeException $e ) { return $e->getMessage(); }
