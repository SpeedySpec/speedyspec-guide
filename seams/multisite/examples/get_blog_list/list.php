<?php
// Public, not archived, spam or deleted sites of the network, a page at a time, with their post counts; deprecated in 3.0.0 for wp_get_sites().
add_action( 'deprecated_function_run', fn( $f, $r, $v ) => print( "$f is deprecated since $v" . ( $r ? " for $r" : '' ) . "\n" ), 10, 3 );
$site = wp_insert_site( array( 'domain' => 'example.org', 'path' => '/second/', 'title' => 'Second' ) );
return wp_list_pluck( get_blog_list( 0, 'all' ), 'path' );
