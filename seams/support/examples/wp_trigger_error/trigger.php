<?php
// Raises a PHP error with the function's name before the message, at a level (a notice by default), when WP_DEBUG is on; wp_trigger_error_always_run fires first and wp_trigger_error_trigger_error can stop it.
add_action( 'wp_trigger_error_always_run', fn( $function, $message ) => print( "$function: $message\n" ), 10, 2 );
wp_trigger_error( 'some_function', 'Something is off.' );
return WP_DEBUG;
