<?php
// A random password; deprecated in 3.0.0 for wp_generate_password().
function guide_report_deprecated( $function_name, $replacement, $version ) {
	echo "$function_name is deprecated since $version" . ( $replacement ? " for $replacement" : '' ) . "\n";
}
add_action( 'deprecated_function_run', 'guide_report_deprecated', 10, 3 );
return strlen( generate_random_password( 10 ) );
