<?php
// Gave terms network-wide IDs while global terms were on; that feature was removed and it is deprecated in 6.1.0.
add_action( 'deprecated_function_run', fn( $f, $r, $v ) => print( "$f is deprecated since $v" . ( $r ? " for $r" : '' ) . "\n" ), 10, 3 );
return global_terms( 5 );
