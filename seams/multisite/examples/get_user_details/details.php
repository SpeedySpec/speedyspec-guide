<?php
// A user's row by login; deprecated in 3.0.0 for get_user_by().
function guide_report_deprecated( $function_name, $replacement, $version ) {
	echo "$function_name is deprecated since $version" . ( $replacement ? " for $replacement" : '' ) . "\n";
}
add_action( 'deprecated_function_run', 'guide_report_deprecated', 10, 3 );
return get_user_details( 'admin' )->user_email;
