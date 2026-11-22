<?php
// Hooked to rest_post_dispatch: keeps only the fields named in the request's _fields parameter, nested fields with dots.
$id = wp_insert_post( array( 'post_title' => 'Trim', 'post_status' => 'publish' ) );
$response = rest_do_request( new WP_REST_Request( 'GET', "/wp/v2/posts/$id" ) );
$request = new WP_REST_Request( 'GET', "/wp/v2/posts/$id" );
$request->set_param( '_fields', 'id,title.rendered' );
return array_keys( rest_filter_response_fields( $response, rest_get_server(), $request )->get_data() );
