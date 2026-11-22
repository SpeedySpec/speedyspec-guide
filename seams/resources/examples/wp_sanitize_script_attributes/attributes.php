<?php
// A string of HTML attributes for a script tag, booleans as bare names; deprecated in 7.0.0 for wp_get_script_tag() and wp_get_inline_script_tag().
function guide_print_deprecated_function( $function_name, $replacement, $version ) {
	echo "$function_name is deprecated since $version\n";
}
add_action( 'deprecated_function_run', 'guide_print_deprecated_function', 10, 3 );
return wp_sanitize_script_attributes( array( 'async' => true, 'defer' => false, 'src' => 'a.js?x=1&y=2' ) );
