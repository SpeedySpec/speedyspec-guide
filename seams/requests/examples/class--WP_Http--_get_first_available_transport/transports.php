<?php
// The first old transport class (curl, streams) whose test passes, as http_api_transports orders them; _dispatch_request() used it.
add_filter( 'http_api_transports', fn( $t ) => array( 'streams' ) );
return ( new WP_Http() )->_get_first_available_transport( array() );
