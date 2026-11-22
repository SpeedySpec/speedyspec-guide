<?php
// Sets the concatenation and compression globals to false when unset; deprecated in 7.2.0, when script concatenation was removed.
function guide_print_deprecated_function( $function_name, $replacement, $version ) {
	echo "$function_name is deprecated since $version\n";
}
add_action( 'deprecated_function_run', 'guide_print_deprecated_function', 10, 3 );
script_concat_settings();
return array( $GLOBALS['concatenate_scripts'], $GLOBALS['compress_scripts'], $GLOBALS['compress_css'] );
