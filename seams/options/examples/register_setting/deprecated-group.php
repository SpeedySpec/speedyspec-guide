<?php
// The removed groups misc and privacy are reported and become general and reading.
add_action( 'deprecated_argument_run', function ( $function_name, $message, $version ) {
	echo "$function_name $version ";
}, 10, 3 );
register_setting( 'privacy', 'guide_private' );
global $new_allowed_options;
return $new_allowed_options['reading'];
