<?php
// Does nothing but report its deprecation since 3.0.0; clean_post_cache() replaces it.
function guide_report_deprecated( $function_name, $replacement, $version ) {
	echo "$function_name is deprecated since $version" . ( $replacement ? " for $replacement" : '' ) . "\n";
}
add_action( 'deprecated_function_run', 'guide_report_deprecated', 10, 3 );
clear_global_post_cache( 1 );
return 'reported';
