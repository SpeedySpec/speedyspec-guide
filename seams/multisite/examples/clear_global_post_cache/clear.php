<?php
// Does nothing but report its deprecation since 3.0.0; clean_post_cache() replaces it.
add_action( 'deprecated_function_run', fn( $f, $r, $v ) => print( "$f is deprecated since $v" . ( $r ? " for $r" : '' ) . "\n" ), 10, 3 );
clear_global_post_cache( 1 );
return 'reported';
