<?php
// Raises a PHP error with the function's name before the message, at a level (a notice by default), when WP_DEBUG is on; wp_trigger_error_always_run fires first and wp_trigger_error_trigger_error can stop it.
function guide_print_triggered_error( $function, $message ) {
	echo "$function: $message\n";
}
add_action( 'wp_trigger_error_always_run', 'guide_print_triggered_error', 10, 2 );
wp_trigger_error( 'some_function', 'Something is off.' );
return WP_DEBUG;
