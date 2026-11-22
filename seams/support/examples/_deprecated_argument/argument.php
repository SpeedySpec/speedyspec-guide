<?php
// Reports a deprecated argument: fires deprecated_argument_run, then raises a notice when debugging allows it.
function guide_print_deprecated_argument( $function, $message, $version ) {
	echo "$function: $message ($version)\n";
}
add_action( 'deprecated_argument_run', 'guide_print_deprecated_argument', 10, 3 );
_deprecated_argument( 'some_function', '5.5.0', 'The second argument is unused.' );
return 'reported';
