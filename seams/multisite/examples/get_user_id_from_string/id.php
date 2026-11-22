<?php
// A user's ID by email or login, or 0; deprecated in 3.6.0 for get_user_by().
function guide_report_deprecated( $function_name, $replacement, $version ) {
	echo "$function_name is deprecated since $version" . ( $replacement ? " for $replacement" : '' ) . "\n";
}
add_action( 'deprecated_function_run', 'guide_report_deprecated', 10, 3 );
return array( get_user_id_from_string( 'admin@example.org' ), get_user_id_from_string( 'admin' ), get_user_id_from_string( 'nobody' ) );
