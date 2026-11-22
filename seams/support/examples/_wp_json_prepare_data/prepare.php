<?php
// The value as given; it once prepared data for old PHP JSON encoding and is deprecated in 5.3.0.
function guide_print_deprecated_function( $function ) {
	echo "$function is deprecated\n";
}
add_action( 'deprecated_function_run', 'guide_print_deprecated_function' );
return _wp_json_prepare_data( array( 1 ) );
