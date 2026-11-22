<?php
// Whether the site URL is https, through the site_url filter.
function guide_https_site_url( $url ) {
	return str_replace( 'http://', 'https://', $url );
}
add_filter( 'site_url', 'guide_https_site_url' );
return wp_is_site_url_using_https();
