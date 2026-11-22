<?php
// Deprecated in 3.5.0; use get_post_ancestors(). Retrieve post ancestors. Calling it reports the deprecation (deprecated_function_run).
$f = guide_fixtures();
$post = $f['post'];
add_action( 'deprecated_function_run', fn( $n, $r, $v ) => print( "deprecated $n since $v" . ( $r ? ", use $r" : '' ) . "\n" ), 10, 3 );
ob_start();
$result = _get_post_ancestors( $post );
return array( $result, trim( preg_replace( '/\s+/', ' ', ob_get_clean() ) ) );
