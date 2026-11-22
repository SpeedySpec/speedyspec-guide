<?php
// The filters on the defaults: redirection count, HTTP version, user agent, rejecting unsafe URLs.
guide_queue_http( "HTTP/1.1 200 OK\r\nContent-Type: text/plain\r\nSet-Cookie: sid=abc; path=/\r\nX-Two: a\r\nX-Two: b\r\n\r\nHello" );
function guide_no_redirects( $count ) {
	return 0;
}
add_filter( 'http_request_redirection_count', 'guide_no_redirects' );
function guide_http_version( $version ) {
	return '1.1';
}
add_filter( 'http_request_version', 'guide_http_version' );
function guide_user_agent( $user_agent ) {
	return 'Guide/1';
}
add_filter( 'http_headers_useragent', 'guide_user_agent' );
function guide_request_timeout( $timeout ) {
	return 9;
}
add_filter( 'http_request_timeout', 'guide_request_timeout' );
class Guide_Request_Args_Recorder {
	public $args = array();

	public function record( $args ) {
		$this->args = $args;
		return $args;
	}
}
$recorder = new Guide_Request_Args_Recorder();
add_filter( 'http_request_args', array( $recorder, 'record' ) );
wp_remote_get( 'http://example.org/' );
$args = $recorder->args;
return array( $args['redirection'], $args['httpversion'], $args['user-agent'], $args['timeout'], $args['reject_unsafe_urls'] );
