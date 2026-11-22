<?php
// An origin when allowed, else ''; allowed_http_origin filters the answer.
function guide_allow_partner_origin( $origin, $origin_arg ) {
	return $origin ?: ( 'https://partner.example' === $origin_arg ? $origin_arg : '' );
}
add_filter( 'allowed_http_origin', 'guide_allow_partner_origin', 10, 2 );
return array( is_allowed_http_origin( 'http://example.org' ), is_allowed_http_origin( 'https://partner.example' ), is_allowed_http_origin( 'https://other.example' ) );
