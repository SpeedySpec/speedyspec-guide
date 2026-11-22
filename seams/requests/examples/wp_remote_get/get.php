<?php
// wp_remote_get(), wp_remote_post() and wp_remote_head() set the method.
guide_queue_http( "HTTP/1.1 200 OK\r\nContent-Type: text/plain\r\nSet-Cookie: sid=abc; path=/\r\nX-Two: a\r\nX-Two: b\r\n\r\nHello", "HTTP/1.1 200 OK\r\nContent-Type: text/plain\r\nSet-Cookie: sid=abc; path=/\r\nX-Two: a\r\nX-Two: b\r\n\r\nHello", "HTTP/1.1 204 No Content\r\n\r\n" );
wp_remote_get( 'http://example.org/a' );
wp_remote_post( 'http://example.org/b', array( 'body' => 'x=1' ) );
$head = wp_remote_head( 'http://example.org/c' );
return array( array_column( Guide_Queue_Transport::$sent, 'method' ), array_column( Guide_Queue_Transport::$sent, 'url' ), wp_remote_retrieve_response_code( $head ) );
