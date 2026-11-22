<?php
// Sends the CORS headers for an allowed origin and returns it; otherwise false (and an OPTIONS preflight from elsewhere gets 403).
$_SERVER['REQUEST_METHOD'] = 'GET';
$_SERVER['HTTP_ORIGIN'] = 'http://example.org';
$allowed = send_origin_headers();
$_SERVER['HTTP_ORIGIN'] = 'https://evil.example';
return array( $allowed, send_origin_headers() );
