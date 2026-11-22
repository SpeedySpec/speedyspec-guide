<?php
// A HEAD request; the response has no body.
guide_queue_http( "HTTP/1.1 200 OK\r\nContent-Length: 5\r\n\r\n" );
$r = wp_remote_head( 'http://example.org/' );
return array( Guide_Queue_Transport::$sent[0]['method'], wp_remote_retrieve_header( $r, 'content-length' ), $r['body'] );
