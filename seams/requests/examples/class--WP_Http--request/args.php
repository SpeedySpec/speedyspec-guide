<?php
// WP_Http::request(): defaults (5-second timeout, 5 redirects, the WordPress user agent), filters on the arguments, pre_http_request to answer first, http_api_debug and http_response after.
guide_queue_http( "HTTP/1.1 200 OK\r\nContent-Type: text/plain\r\nSet-Cookie: sid=abc; path=/\r\nX-Two: a\r\nX-Two: b\r\n\r\nHello" );
add_action( 'http_api_debug', fn( $r, $ctx, $class ) => print( "http_api_debug $ctx $class\n" ), 10, 3 );
add_filter( 'http_response', fn( $r ) => array_merge( $r, array( 'body' => strtoupper( $r['body'] ) ) ) );
$http = new WP_Http();
$r = $http->request( 'http://example.org/' );
add_filter( 'pre_http_request', fn( $pre, $args, $url ) => array( 'body' => 'short-circuited', 'response' => array( 'code' => 299 ) ), 10, 3 );
$pre = $http->request( 'http://example.org/' );
return array( $r['body'], $pre['body'] );
