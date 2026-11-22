<?php
// The status message, or '' for an error.
guide_queue_http( "HTTP/1.1 404 Not Found\r\n\r\n" );
return wp_remote_retrieve_response_message( wp_remote_get( 'http://example.org/' ) );
