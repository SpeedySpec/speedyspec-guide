<?php
// A site's URL from its domain and path, joined as given; deprecated in 3.7.0.
function guide_report_deprecated( $function_name, $replacement, $version ) {
	echo "$function_name is deprecated since $version" . ( $replacement ? " for $replacement" : '' ) . "\n";
}
add_action( 'deprecated_function_run', 'guide_report_deprecated', 10, 3 );
return get_blogaddress_by_domain( 'example.org', '/team/' );
