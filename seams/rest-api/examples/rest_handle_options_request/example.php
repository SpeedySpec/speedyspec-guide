<?php
// Hooked to rest_pre_dispatch: answers an OPTIONS request with the matched route's data (its namespace, methods and arguments) instead of calling it; other requests pass through.
$request = new WP_REST_Request( 'OPTIONS', '/wp/v2/posts' );
$response = rest_handle_options_request( null, rest_get_server(), $request );
return array( $response->get_matched_route(), $response->get_data()['namespace'], $response->get_data()['methods'], rest_handle_options_request( null, rest_get_server(), new WP_REST_Request( 'GET', '/' ) ) );
