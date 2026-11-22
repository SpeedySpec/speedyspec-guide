<?php
// The response's cookies as WP_Http_Cookie objects; one by name, or its value.
guide_queue_http( "HTTP/1.1 200 OK\r\nContent-Type: text/plain\r\nSet-Cookie: sid=abc; path=/\r\nX-Two: a\r\nX-Two: b\r\n\r\nHello" );
$r = wp_remote_get( 'http://example.org/' );
$cookies = wp_remote_retrieve_cookies( $r );
return array( get_class( $cookies[0] ), $cookies[0]->name, get_class( wp_remote_retrieve_cookie( $r, 'sid' ) ), wp_remote_retrieve_cookie( $r, 'nope' ), wp_remote_retrieve_cookie_value( $r, 'sid' ), wp_remote_retrieve_cookie_value( $r, 'nope' ) );
