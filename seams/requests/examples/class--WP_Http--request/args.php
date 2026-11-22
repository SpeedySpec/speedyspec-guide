<?php
// WP_Http::request(): defaults (5-second timeout, 5 redirects, the WordPress user agent), filters on the arguments, pre_http_request to answer first, http_api_debug and http_response after.
guide_queue_http( "HTTP/1.1 200 OK\r\nContent-Type: text/plain\r\nSet-Cookie: sid=abc; path=/\r\nX-Two: a\r\nX-Two: b\r\n\r\nHello" );
function guide_report_http_api_debug( $response, $context, $class ) {
	echo esc_html( "http_api_debug $context $class\n" );
}
add_action( 'http_api_debug', 'guide_report_http_api_debug', 10, 3 );
function guide_uppercase_response_body( $response ) {
	return array_merge( $response, array( 'body' => strtoupper( $response['body'] ) ) );
}
add_filter( 'http_response', 'guide_uppercase_response_body' );
$http = new WP_Http();
$r = $http->request( 'http://example.org/' );
function guide_short_circuit_request( $pre, $args, $url ) {
	return array( 'body' => 'short-circuited', 'response' => array( 'code' => 299 ) );
}
add_filter( 'pre_http_request', 'guide_short_circuit_request', 10, 3 );
$pre = $http->request( 'http://example.org/' );
return array( $r['body'], $pre['body'] );
