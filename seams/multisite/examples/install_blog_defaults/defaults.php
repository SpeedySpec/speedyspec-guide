<?php
// Gave a new site its default content; deprecated in 4.4.0, for wp_install_defaults().
add_action( 'deprecated_function_run', fn( $f, $r, $v ) => print( "$f is deprecated since $v" . ( $r ? " for $r" : '' ) . "\n" ), 10, 3 );
return function_exists( 'install_blog_defaults' );
