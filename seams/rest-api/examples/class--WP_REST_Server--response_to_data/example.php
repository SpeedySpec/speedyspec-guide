<?php
// A response's data as sent: with its links as _links (CURIEs compacted), embedded resources under _embedded when asked.
$id = wp_insert_post( array( 'post_title' => 'Linked', 'post_status' => 'publish' ) );
$server = rest_get_server();
$response = $server->dispatch( new WP_REST_Request( 'GET', "/wp/v2/posts/$id" ) );
$data = $server->response_to_data( $response, true );
return array( array_slice( array_keys( $data['_links'] ), 0, 4 ), array_keys( $data['_embedded'] ) );
