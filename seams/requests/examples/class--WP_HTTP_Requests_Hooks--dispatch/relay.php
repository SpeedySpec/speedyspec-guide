<?php
// Relays Requests' hooks as requests-{hook} actions, and curl.before_send as http_api_curl.
guide_queue_http( "HTTP/1.1 200 OK\r\nContent-Type: text/plain\r\nSet-Cookie: sid=abc; path=/\r\nX-Two: a\r\nX-Two: b\r\n\r\nHello" );
add_action( 'requests-requests.before_parse', fn() => print( "requests-requests.before_parse\n" ) );
add_action( 'requests-requests.after_request', fn() => print( "requests-requests.after_request\n" ) );
wp_remote_get( 'http://example.org/' );
return null;
