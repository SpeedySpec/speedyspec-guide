<?php
// Every option, known or not, then goes through sanitize_option_{$option}, with the option name and the value given.
function guide_name_option_value( $value, $option, $original ) {
	return "$option=$value";
}
add_filter( 'sanitize_option_guide', 'guide_name_option_value', 10, 3 );
return sanitize_option( 'guide', 'x' );
