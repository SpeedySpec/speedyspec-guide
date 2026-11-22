<?php
// The retrieve helpers read a response safely: a WP_Error or missing part gives an empty value.
guide_queue_http( "HTTP/1.1 200 OK\r\nContent-Type: text/plain\r\nSet-Cookie: sid=abc; path=/\r\nX-Two: a\r\nX-Two: b\r\n\r\nHello" );
$r = wp_remote_get( 'http://example.org/' );
$err = new WP_Error( 'x' );
return array( get_class( wp_remote_retrieve_headers( $r ) ), wp_remote_retrieve_header( $r, 'X-Two' ), wp_remote_retrieve_header( $r, 'missing' ), wp_remote_retrieve_response_code( $r ), wp_remote_retrieve_response_message( $r ), wp_remote_retrieve_body( $r ), wp_remote_retrieve_headers( $err ), wp_remote_retrieve_response_code( $err ), wp_remote_retrieve_body( $err ) );
