<?php
// Creates a site with no content for a domain, path and title, or gives an error message when the address is taken; deprecated in 4.4.0.
function guide_report_deprecated( $function_name, $replacement, $version ) {
	echo "$function_name is deprecated since $version" . ( $replacement ? " for $replacement" : '' ) . "\n";
}
add_action( 'deprecated_function_run', 'guide_report_deprecated', 10, 3 );
return create_empty_blog( 'example.org', '/', 'Main again' );
