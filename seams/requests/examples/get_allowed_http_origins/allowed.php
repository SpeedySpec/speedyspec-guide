<?php
// The http and https forms of the home and admin hosts; allowed_http_origins filters them.
function guide_allow_app_origin( $origins ) {
	return array_merge( $origins, array( 'https://app.example' ) );
}
add_filter( 'allowed_http_origins', 'guide_allow_app_origin' );
return get_allowed_http_origins();
