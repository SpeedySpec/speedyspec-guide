<?php
// wp_max_autoloaded_option_size changes the limit.
function guide_max_autoloaded_option_size( $max ) {
	return 10;
}
add_filter( 'wp_max_autoloaded_option_size', 'guide_max_autoloaded_option_size' );
return wp_filter_default_autoload_value_via_option_size( null, 'guide', 'v', 'eleven char' );
