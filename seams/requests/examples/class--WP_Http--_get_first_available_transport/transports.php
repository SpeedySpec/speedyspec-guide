<?php
// The first old transport class (curl, streams) whose test passes, as http_api_transports orders them; _dispatch_request() used it.
function guide_only_streams_transport( $transports ) {
	return array( 'streams' );
}
add_filter( 'http_api_transports', 'guide_only_streams_transport' );
return ( new WP_Http() )->_get_first_available_transport( array() );
