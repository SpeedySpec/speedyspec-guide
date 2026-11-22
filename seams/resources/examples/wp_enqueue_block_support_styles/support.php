<?php
// Prints block support CSS in the head (or footer, once the head is printed) at a priority; deprecated in 6.1.0 for the style engine's stored styles.
function guide_print_deprecated_function( $function_name, $replacement, $version ) {
	echo "$function_name is deprecated since $version\n";
}
add_action( 'deprecated_function_run', 'guide_print_deprecated_function', 10, 3 );
wp_enqueue_block_support_styles( '.x{color:red}' );
return has_action( 'wp_head' ) !== false;
