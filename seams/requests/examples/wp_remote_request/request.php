<?php
// Sends a request with WP_Http and returns the response array: headers, body, response code and message, cookies and the response object; a failure is a WP_Error.
guide_queue_http( "HTTP/1.1 200 OK\r\nContent-Type: text/plain\r\nSet-Cookie: sid=abc; path=/\r\nX-Two: a\r\nX-Two: b\r\n\r\nHello" );
$r = wp_remote_request( 'http://example.org/x', array( 'method' => 'PUT', 'body' => array( 'a' => 1 ) ) );
return array( array_keys( $r ), $r['response'], $r['body'], Guide_Queue_Transport::$sent[0]['method'], Guide_Queue_Transport::$sent[0]['data'], wp_remote_request( 'not a url' )->get_error_message() );
