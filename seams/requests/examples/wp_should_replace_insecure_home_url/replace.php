<?php
// Only for a site using HTTPS whose https_migration_required option is set (and home and site share a host); wp_should_replace_insecure_home_url filters it. wp_replace_insecure_home_url() then rewrites http home URLs, escaped or not.
function guide_https_home( $pre ) {
	return 'https://example.org';
}
add_filter( 'pre_option_home', 'guide_https_home', 20 );
function guide_https_siteurl( $pre ) {
	return 'https://example.org';
}
add_filter( 'pre_option_siteurl', 'guide_https_siteurl', 20 );
function guide_https_migration_required( $pre ) {
	return '1';
}
add_filter( 'pre_option_https_migration_required', 'guide_https_migration_required' );
$content = 'See http://example.org/a and http:\\/\\/example.org\\/b';
return array( wp_should_replace_insecure_home_url(), wp_replace_insecure_home_url( $content ) );
