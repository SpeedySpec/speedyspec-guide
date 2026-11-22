<?php
// Makes a site's tables and its default options; deprecated in 5.1.0, done now by wp_initialize_site().
function guide_report_deprecated( $function_name, $replacement, $version ) {
	echo "$function_name is deprecated since $version" . ( $replacement ? " for $replacement" : '' ) . "\n";
}
add_action( 'deprecated_function_run', 'guide_report_deprecated', 10, 3 );
return function_exists( 'install_blog' );
