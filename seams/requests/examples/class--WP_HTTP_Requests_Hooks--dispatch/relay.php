<?php
// Relays Requests' hooks as requests-{hook} actions, and curl.before_send as http_api_curl.
guide_queue_http( "HTTP/1.1 200 OK\r\nContent-Type: text/plain\r\nSet-Cookie: sid=abc; path=/\r\nX-Two: a\r\nX-Two: b\r\n\r\nHello" );
function guide_announce_before_parse() {
	echo "requests-requests.before_parse\n";
}
add_action( 'requests-requests.before_parse', 'guide_announce_before_parse' );
function guide_announce_after_request() {
	echo "requests-requests.after_request\n";
}
add_action( 'requests-requests.after_request', 'guide_announce_after_request' );
wp_remote_get( 'http://example.org/' );
return null;
