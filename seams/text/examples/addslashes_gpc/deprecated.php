<?php
// Deprecated in 7.0.0 for wp_slash(): it still slashes, and reports the deprecation through deprecated_function_run.
function guide_print_deprecated_function( $name, $replacement, $version ) {
	echo "$name $version $replacement";
}
add_action( 'deprecated_function_run', 'guide_print_deprecated_function', 10, 3 );
return addslashes_gpc( "it's" );
