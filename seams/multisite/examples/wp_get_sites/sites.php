<?php
// The network's sites as arrays; deprecated in 4.6.0 for get_sites().
add_action( 'deprecated_function_run', fn( $f, $r, $v ) => print( "$f is deprecated since $v" . ( $r ? " for $r" : '' ) . "\n" ), 10, 3 );
$site = wp_insert_site( array( 'domain' => 'example.org', 'path' => '/second/', 'title' => 'Second' ) );
return wp_list_pluck( wp_get_sites(), 'path' );
