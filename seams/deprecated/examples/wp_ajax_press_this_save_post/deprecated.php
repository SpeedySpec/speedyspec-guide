<?php
// Deprecated in 4.9.0. Ajax handler for saving a post from Press This. Calling it reports the deprecation (deprecated_function_run).
$f = guide_fixtures();
add_filter( 'wp_doing_ajax', '__return_true' );
function guide_throw_wp_die( $message ) {
	throw new Exception( 'wp_die' );
}
function guide_wp_die_handler( $handler ) {
	return 'guide_throw_wp_die';
}
add_filter( 'wp_die_ajax_handler', 'guide_wp_die_handler' );
try {
    $result = guide_deprecated( 'wp_ajax_press_this_save_post' );
} catch ( Exception $e ) {
    $result = $e->getMessage();
}
return $result;
