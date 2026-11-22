<?php
// Gave a new site its default content; deprecated in 4.4.0, for wp_install_defaults().
function guide_report_deprecated( $function_name, $replacement, $version ) {
	echo "$function_name is deprecated since $version" . ( $replacement ? " for $replacement" : '' ) . "\n";
}
add_action( 'deprecated_function_run', 'guide_report_deprecated', 10, 3 );
return function_exists( 'install_blog_defaults' );
