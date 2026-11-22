<?php
// A network's object by ID; deprecated in 4.7.0 for get_network().
add_action( 'deprecated_function_run', fn( $f ) => print( "$f is deprecated\n" ) );
return wp_get_network( 1 )->domain;
