<?php
// Public, not archived, spam or deleted sites of the network, a page at a time, with their post counts; deprecated in 3.0.0 for wp_get_sites().
function guide_report_deprecated( $function_name, $replacement, $version ) {
	echo "$function_name is deprecated since $version" . ( $replacement ? " for $replacement" : '' ) . "\n";
}
add_action( 'deprecated_function_run', 'guide_report_deprecated', 10, 3 );
$site = wp_insert_site( array( 'domain' => 'example.org', 'path' => '/second/', 'title' => 'Second' ) );
return wp_list_pluck( get_blog_list( 0, 'all' ), 'path' );
