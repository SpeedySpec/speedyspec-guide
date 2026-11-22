<?php
// Makes a site's tables and its default options; deprecated in 5.1.0, done now by wp_initialize_site().
add_action( 'deprecated_function_run', fn( $f, $r, $v ) => print( "$f is deprecated since $v" . ( $r ? " for $r" : '' ) . "\n" ), 10, 3 );
return function_exists( 'install_blog' );
