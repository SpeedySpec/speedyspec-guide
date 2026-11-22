<?php
// Whether a user (by login, the current one by default) is a network super admin; deprecated in 3.0.0 for is_super_admin().
function guide_report_deprecated( $function_name, $replacement, $version ) {
	echo "$function_name is deprecated since $version" . ( $replacement ? " for $replacement" : '' ) . "\n";
}
add_action( 'deprecated_function_run', 'guide_report_deprecated', 10, 3 );
return array( is_site_admin(), is_site_admin( 'admin' ) );
