<?php
// The body, or '' for an error.
guide_queue_http( "HTTP/1.1 200 OK\r\nContent-Type: text/plain\r\nSet-Cookie: sid=abc; path=/\r\nX-Two: a\r\nX-Two: b\r\n\r\nHello" );
return array( wp_remote_retrieve_body( wp_remote_get( 'http://example.org/' ) ), wp_remote_retrieve_body( new WP_Error() ) );
