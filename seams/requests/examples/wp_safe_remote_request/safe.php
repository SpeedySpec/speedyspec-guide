<?php
// The safe variants reject unsafe URLs: other schemes, credentials, hosts that resolve to private, loopback or reserved addresses (unless http_request_host_is_external allows them), and bracketed IPv6 hosts.
guide_queue_http( "HTTP/1.1 200 OK\r\nContent-Type: text/plain\r\nSet-Cookie: sid=abc; path=/\r\nX-Two: a\r\nX-Two: b\r\n\r\nHello" );
$blocked = wp_safe_remote_request( 'http://127.0.0.1/admin' );
$own = wp_safe_remote_get( 'http://example.org/ok' );
return array( $blocked->get_error_message(), wp_remote_retrieve_body( $own ), is_wp_error( wp_safe_remote_post( 'http://user:pass@example.org/' ) ), is_wp_error( wp_safe_remote_head( 'ftp://example.org/' ) ) );
