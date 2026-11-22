<?php
// wp_safe_remote_get() is a GET with reject_unsafe_urls on.
guide_queue_http( "HTTP/1.1 200 OK\r\nContent-Type: text/plain\r\nSet-Cookie: sid=abc; path=/\r\nX-Two: a\r\nX-Two: b\r\n\r\nHello" );
return array( wp_remote_retrieve_body( wp_safe_remote_get( 'http://example.org/' ) ), wp_safe_remote_get( 'http://10.0.0.1/' )->get_error_code() );
