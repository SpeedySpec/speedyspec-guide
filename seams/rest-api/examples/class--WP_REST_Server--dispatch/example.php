<?php
// The REST server: routes by namespace, matching a request to a route and handler, checking permissions and arguments, calling the callback and running the dispatch filters; serve_request() does this for an HTTP request and sends the JSON.
$server = rest_get_server();
$response = $server->dispatch( new WP_REST_Request( 'GET', '/wp/v2/nothing-here' ) );
return array( in_array( 'wp/v2', $server->get_namespaces(), true ), $response->get_status(), $response->get_data()['code'], $server->get_route_options( '/wp/v2/posts' )['namespace'] );
