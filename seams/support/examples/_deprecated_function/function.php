<?php
// Reports a deprecated function: fires deprecated_function_run, then raises a notice when WP_DEBUG is on and deprecated_function_trigger_error allows it.
function guide_print_deprecated_function( $function, $replacement, $version ) {
	echo "$function is deprecated since $version\n";
}
add_action( 'deprecated_function_run', 'guide_print_deprecated_function', 10, 3 );
_deprecated_function( 'old_thing', '6.0.0', 'new_thing' );
return 'reported';
