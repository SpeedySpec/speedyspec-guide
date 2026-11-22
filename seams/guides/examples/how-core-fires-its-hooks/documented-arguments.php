<?php
// A hook passes exactly the arguments its docblock lists: here default_option_{$option}'s three.
function guide_record_default_option_arguments( $default_value, $option, $passed_default ) {
	$GLOBALS['guide_calls'][] = array( 'default' => $default_value, 'option' => $option, 'passed a default' => $passed_default );
	return $default_value;
}
add_filter( 'default_option_guide_size', 'guide_record_default_option_arguments', 10, 3 );

get_option( 'guide_size' );
get_option( 'guide_size', 'small' );
return $GLOBALS['guide_calls'];
