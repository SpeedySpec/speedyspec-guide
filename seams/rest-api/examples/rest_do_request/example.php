<?php
// Dispatches a request (or a route string) through the REST server in the same process and gives back the response, with fields and embeds applied.
$id = wp_insert_post( array( 'post_title' => 'Inside', 'post_status' => 'publish' ) );
$response = rest_do_request( "/wp/v2/posts/$id" );
return array( $response->get_status(), $response->get_data()['title']['rendered'] );
