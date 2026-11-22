<?php
// The status code, or '' for an error.
guide_queue_http( "HTTP/1.1 404 Not Found\r\n\r\n" );
return array( wp_remote_retrieve_response_code( wp_remote_get( 'http://example.org/' ) ), wp_remote_retrieve_response_code( new WP_Error() ) );
