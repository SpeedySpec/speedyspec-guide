<?php
// The filters on the defaults: redirection count, HTTP version, user agent, rejecting unsafe URLs.
guide_queue_http( "HTTP/1.1 200 OK\r\nContent-Type: text/plain\r\nSet-Cookie: sid=abc; path=/\r\nX-Two: a\r\nX-Two: b\r\n\r\nHello" );
add_filter( 'http_request_redirection_count', fn() => 0 );
add_filter( 'http_request_version', fn() => '1.1' );
add_filter( 'http_headers_useragent', fn( $ua ) => 'Guide/1' );
add_filter( 'http_request_timeout', fn() => 9 );
$args = array();
add_filter( 'http_request_args', function ( $a ) use ( &$args ) { $args = $a; return $a; } );
wp_remote_get( 'http://example.org/' );
return array( $args['redirection'], $args['httpversion'], $args['user-agent'], $args['timeout'], $args['reject_unsafe_urls'] );
