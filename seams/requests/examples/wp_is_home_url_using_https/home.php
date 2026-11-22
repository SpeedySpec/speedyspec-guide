<?php
// Whether the home URL is https.
function guide_https_home( $pre ) {
	return 'https://example.org';
}
add_filter( 'pre_option_home', 'guide_https_home', 20 );
return wp_is_home_url_using_https();
