<?php
// The site users without a site were once given, the main site (or the dashboard_blog option's); deprecated in 3.1.0 for get_site().
function guide_report_deprecated( $function_name, $replacement, $version ) {
	echo "$function_name is deprecated since $version" . ( $replacement ? " for $replacement" : '' ) . "\n";
}
add_action( 'deprecated_function_run', 'guide_report_deprecated', 10, 3 );
return get_dashboard_blog()->blog_id;
