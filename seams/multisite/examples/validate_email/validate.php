<?php
// Whether an email is valid, optionally checking its domain resolves; deprecated in 3.0.0 for is_email().
function guide_report_deprecated( $function_name, $replacement, $version ) {
	echo "$function_name is deprecated since $version" . ( $replacement ? " for $replacement" : '' ) . "\n";
}
add_action( 'deprecated_function_run', 'guide_report_deprecated', 10, 3 );
return array( validate_email( 'ada@example.org', false ), validate_email( 'nope', false ) );
