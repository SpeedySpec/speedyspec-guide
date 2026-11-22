<?php
// A POST sends the body as form data.
guide_queue_http( "HTTP/1.1 200 OK\r\nContent-Type: text/plain\r\nSet-Cookie: sid=abc; path=/\r\nX-Two: a\r\nX-Two: b\r\n\r\nHello" );
wp_remote_post( 'http://example.org/form', array( 'body' => array( 'name' => 'Ada' ) ) );
return array( Guide_Queue_Transport::$sent[0]['method'], Guide_Queue_Transport::$sent[0]['data'] );
