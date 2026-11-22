<?php
// Whether the current site is the network's main site; deprecated in 3.0.0 for is_main_site().
add_action( 'deprecated_function_run', fn( $f, $r, $v ) => print( "$f is deprecated since $v" . ( $r ? " for $r" : '' ) . "\n" ), 10, 3 );
return is_main_blog();
