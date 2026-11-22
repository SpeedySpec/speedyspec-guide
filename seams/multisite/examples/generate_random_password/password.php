<?php
// A random password; deprecated in 3.0.0 for wp_generate_password().
add_action( 'deprecated_function_run', fn( $f, $r, $v ) => print( "$f is deprecated since $v" . ( $r ? " for $r" : '' ) . "\n" ), 10, 3 );
return strlen( generate_random_password( 10 ) );
