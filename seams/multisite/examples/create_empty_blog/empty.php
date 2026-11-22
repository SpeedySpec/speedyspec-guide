<?php
// Creates a site with no content for a domain, path and title, or gives an error message when the address is taken; deprecated in 4.4.0.
add_action( 'deprecated_function_run', fn( $f, $r, $v ) => print( "$f is deprecated since $v" . ( $r ? " for $r" : '' ) . "\n" ), 10, 3 );
return create_empty_blog( 'example.org', '/', 'Main again' );
