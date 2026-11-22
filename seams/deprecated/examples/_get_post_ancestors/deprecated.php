<?php
// Deprecated in 3.5.0; use get_post_ancestors(). Retrieve post ancestors. Calling it reports the deprecation (deprecated_function_run).
$f = guide_fixtures();
$post = $f['post'];
function guide_report_deprecated( $function_name, $replacement, $version ) {
	print( "deprecated $function_name since $version" . ( $replacement ? ", use $replacement" : '' ) . "\n" );
}
add_action( 'deprecated_function_run', 'guide_report_deprecated', 10, 3 );
ob_start();
$result = _get_post_ancestors( $post );
return array( $result, trim( preg_replace( '/\s+/', ' ', ob_get_clean() ) ) );
