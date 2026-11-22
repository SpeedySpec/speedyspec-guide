<?php
// Redirects in the network admin to a URL from the request (ref or redirect) or the referer, then ends the request; deprecated in 3.3.0 for wp_redirect(). Here the redirect is stopped first.
function guide_report_deprecated( $function_name, $replacement, $version ) {
	echo "$function_name is deprecated since $version" . ( $replacement ? " for $replacement" : '' ) . "\n";
}
add_action( 'deprecated_function_run', 'guide_report_deprecated', 10, 3 );
function guide_stop_redirect( $location ) {
	throw new RuntimeException( "redirect to $location" );
}
add_filter( 'wp_redirect', 'guide_stop_redirect' );
$_GET['redirect'] = 'http://example.org/wp-admin/network/';
try { wpmu_admin_do_redirect(); } catch ( RuntimeException $e ) { return $e->getMessage(); }
