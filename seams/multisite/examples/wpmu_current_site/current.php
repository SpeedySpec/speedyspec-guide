<?php
// The current network, the $current_site global; deprecated in 3.9.0.
function guide_report_deprecated( $function_name ) {
	echo "$function_name is deprecated\n";
}
add_action( 'deprecated_function_run', 'guide_report_deprecated' );
return wpmu_current_site()->site_name;
