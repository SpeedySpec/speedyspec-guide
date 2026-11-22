<?php
// The URL prefix of the REST API, wp-json, filtered by rest_url_prefix.
$plain = rest_get_url_prefix();
function guide_api_prefix() {
	return 'api';
}
add_filter( 'rest_url_prefix', 'guide_api_prefix' );
return array( $plain, rest_get_url_prefix() );
