<?php
// Adds a site's row for a domain and path; deprecated in 5.1.0 for wp_insert_site().
function guide_report_deprecated( $function_name, $replacement, $version ) {
	echo "$function_name is deprecated since $version" . ( $replacement ? " for $replacement" : '' ) . "\n";
}
add_action( 'deprecated_function_run', 'guide_report_deprecated', 10, 3 );
$id = insert_blog( 'example.org', '/inserted/', 1 );
return get_site( $id )->path;
