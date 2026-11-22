<?php
// The removed groups misc and privacy are reported and become general and reading.
function guide_report_deprecated_argument( $function_name, $message, $version ) {
	echo "$function_name $version ";
}
add_action( 'deprecated_argument_run', 'guide_report_deprecated_argument', 10, 3 );
register_setting( 'privacy', 'guide_private' );
global $new_allowed_options;
return $new_allowed_options['reading'];
