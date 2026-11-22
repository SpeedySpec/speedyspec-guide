<?php
// Whether the site uses HTTPS: both the home and the site URL must be https (the site URL through site_url).
$http = array( wp_is_using_https(), wp_is_home_url_using_https(), wp_is_site_url_using_https() );
add_filter( 'pre_option_home', fn() => 'https://example.org', 20 );
add_filter( 'pre_option_siteurl', fn() => 'https://example.org', 20 );
return array( $http, wp_is_using_https() );
