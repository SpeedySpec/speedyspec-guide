<?php
// One cookie by name, or ''.
guide_queue_http( "HTTP/1.1 200 OK\r\nContent-Type: text/plain\r\nSet-Cookie: sid=abc; path=/\r\nX-Two: a\r\nX-Two: b\r\n\r\nHello" );
$r = wp_remote_get( 'http://example.org/' );
return array( wp_remote_retrieve_cookie( $r, 'sid' )->value, wp_remote_retrieve_cookie( $r, 'x' ) );
