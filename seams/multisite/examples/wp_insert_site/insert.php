<?php
// Adds a site to the network: its data normalized and validated (domain, path, network, dates, flags), cleaned from the cache, then wp_insert_site and, unless told not to, wp_initialize_site, which makes its tables and options. Gives the ID or an error.
add_action( 'wp_insert_site', fn( $s ) => print( "wp_insert_site {$s->path}\n" ) );
$id = wp_insert_site( array( 'domain' => 'example.org', 'path' => 'second', 'title' => 'Second' ) );
$taken = wp_insert_site( array( 'domain' => 'example.org', 'path' => '/second/' ) );
return array( $id, get_site( $id )->path, get_blog_option( $id, 'blogname' ), $taken->get_error_code() );
