<?php
// The request's Origin header; http_origin filters it. is_allowed_http_origin() keeps it only when it is the site's home or admin host.
$_SERVER['HTTP_ORIGIN'] = 'https://example.org';
$origin = get_http_origin();
return array( $origin, is_allowed_http_origin(), is_allowed_http_origin( 'https://evil.example' ), get_allowed_http_origins() );
