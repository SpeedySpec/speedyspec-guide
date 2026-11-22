<?php
// Whether a value is a WP_Error; fires is_wp_error_instance when it is.
function guide_print_error_code( $error ) {
	echo 'error: ' . $error->get_error_code() . "\n";
}
add_action( 'is_wp_error_instance', 'guide_print_error_code' );
return array( is_wp_error( new WP_Error( 'nope' ) ), is_wp_error( false ) );
