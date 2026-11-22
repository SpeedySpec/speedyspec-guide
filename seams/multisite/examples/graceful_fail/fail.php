<?php
// Prints a plain error page holding a message (both filtered, by graceful_fail and graceful_fail_template) and ends the request; deprecated in 3.0.0 for wp_die(). Here the graceful_fail filter stops it first.
function guide_report_deprecated( $function_name, $replacement, $version ) {
	echo "$function_name is deprecated since $version" . ( $replacement ? " for $replacement" : '' ) . "\n";
}
add_action( 'deprecated_function_run', 'guide_report_deprecated', 10, 3 );
function guide_stop_graceful_fail( $message ) {
	throw new RuntimeException( "graceful_fail: $message" );
}
add_filter( 'graceful_fail', 'guide_stop_graceful_fail' );
try { graceful_fail( 'Something broke.' ); } catch ( RuntimeException $e ) { return $e->getMessage(); }
