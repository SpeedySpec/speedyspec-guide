<?php
// Gave terms network-wide IDs while global terms were on; that feature was removed and it is deprecated in 6.1.0.
function guide_report_deprecated( $function_name, $replacement, $version ) {
	echo "$function_name is deprecated since $version" . ( $replacement ? " for $replacement" : '' ) . "\n";
}
add_action( 'deprecated_function_run', 'guide_report_deprecated', 10, 3 );
return global_terms( 5 );
