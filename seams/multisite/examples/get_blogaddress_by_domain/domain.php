<?php
// A site's URL from its domain and path, joined as given; deprecated in 3.7.0.
add_action( 'deprecated_function_run', fn( $f, $r, $v ) => print( "$f is deprecated since $v" . ( $r ? " for $r" : '' ) . "\n" ), 10, 3 );
return get_blogaddress_by_domain( 'example.org', '/team/' );
