<?php
// Deprecated in 4.9.0. Ajax handler for creating new category from Press This. Calling it reports the deprecation (deprecated_function_run).
$f = guide_fixtures();
add_filter( 'wp_doing_ajax', '__return_true' );
add_filter( 'wp_die_ajax_handler', fn() => function ( $message ) { throw new Exception( 'wp_die' ); } );
try {
    $result = guide_deprecated( 'wp_ajax_press_this_add_category' );
} catch ( Exception $e ) {
    $result = $e->getMessage();
}
return $result;
