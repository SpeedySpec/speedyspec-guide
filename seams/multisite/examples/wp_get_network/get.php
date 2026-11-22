<?php
// A network's object by ID; deprecated in 4.7.0 for get_network().
function guide_report_deprecated( $function_name ) {
	echo "$function_name is deprecated\n";
}
add_action( 'deprecated_function_run', 'guide_report_deprecated' );
return wp_get_network( 1 )->domain;
