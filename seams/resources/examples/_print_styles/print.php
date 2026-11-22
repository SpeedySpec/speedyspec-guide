<?php
// Prints the styles' print_html; deprecated in 7.2.0.
function guide_print_deprecated_function( $function_name, $replacement, $version ) {
	echo "$function_name is deprecated since $version\n";
}
add_action( 'deprecated_function_run', 'guide_print_deprecated_function', 10, 3 );
wp_styles()->print_html = '<style>/* x */</style>';
return guide_render( '_print_styles' );
