<?php
// Adds a site's row for a domain and path; deprecated in 5.1.0 for wp_insert_site().
add_action( 'deprecated_function_run', fn( $f, $r, $v ) => print( "$f is deprecated since $v" . ( $r ? " for $r" : '' ) . "\n" ), 10, 3 );
$id = insert_blog( 'example.org', '/inserted/', 1 );
return get_site( $id )->path;
