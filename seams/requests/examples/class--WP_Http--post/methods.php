<?php
// post(), get() and head() set the method on request().
guide_queue_http( "HTTP/1.1 200 OK\r\nContent-Type: text/plain\r\nSet-Cookie: sid=abc; path=/\r\nX-Two: a\r\nX-Two: b\r\n\r\nHello", "HTTP/1.1 200 OK\r\nContent-Type: text/plain\r\nSet-Cookie: sid=abc; path=/\r\nX-Two: a\r\nX-Two: b\r\n\r\nHello", "HTTP/1.1 200 OK\r\nContent-Type: text/plain\r\nSet-Cookie: sid=abc; path=/\r\nX-Two: a\r\nX-Two: b\r\n\r\nHello" );
$http = new WP_Http();
$http->post( 'http://example.org/' );
$http->get( 'http://example.org/' );
$http->head( 'http://example.org/' );
return array_column( Guide_Queue_Transport::$sent, 'method' );
