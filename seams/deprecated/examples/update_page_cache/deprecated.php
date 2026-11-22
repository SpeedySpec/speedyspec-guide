<?php
// Deprecated in 3.4.0; use update_post_cache(). Alias of update_post_cache(). Calling it reports the deprecation (deprecated_function_run).
$f = guide_fixtures();
$pages = array( get_post( $f['page'] ) );
function guide_report_deprecated( $function_name, $replacement, $version ) {
	print( "deprecated $function_name since $version" . ( $replacement ? ", use $replacement" : '' ) . "\n" );
}
add_action( 'deprecated_function_run', 'guide_report_deprecated', 10, 3 );
ob_start();
$result = update_page_cache( $pages );
return array( $result, trim( preg_replace( '/\s+/', ' ', ob_get_clean() ) ) );
