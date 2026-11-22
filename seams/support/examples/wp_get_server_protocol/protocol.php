<?php
// The request's HTTP protocol from SERVER_PROTOCOL: HTTP/1.1, HTTP/2 or HTTP/3 as given, anything else HTTP/1.0.
$_SERVER['SERVER_PROTOCOL'] = 'HTTP/2';
$two = wp_get_server_protocol();
$_SERVER['SERVER_PROTOCOL'] = 'SPDY';
return array( $two, wp_get_server_protocol() );
