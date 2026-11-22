<?php
// A URL with updated=true added, unless it has it; deprecated in 3.3.0 for add_query_arg().
function guide_report_deprecated( $function_name, $replacement, $version ) {
	echo "$function_name is deprecated since $version" . ( $replacement ? " for $replacement" : '' ) . "\n";
}
add_action( 'deprecated_function_run', 'guide_report_deprecated', 10, 3 );
return wpmu_admin_redirect_add_updated_param( 'http://example.org/wp-admin/network/sites.php' );
