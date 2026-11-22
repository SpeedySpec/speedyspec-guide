<?php
// Whether the site uses HTTPS: both the home and the site URL must be https (the site URL through site_url).
$http = array( wp_is_using_https(), wp_is_home_url_using_https(), wp_is_site_url_using_https() );
function guide_https_home( $pre ) {
	return 'https://example.org';
}
add_filter( 'pre_option_home', 'guide_https_home', 20 );
function guide_https_siteurl( $pre ) {
	return 'https://example.org';
}
add_filter( 'pre_option_siteurl', 'guide_https_siteurl', 20 );
return array( $http, wp_is_using_https() );
