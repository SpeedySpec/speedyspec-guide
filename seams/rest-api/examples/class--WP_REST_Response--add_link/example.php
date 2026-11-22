<?php
// A REST response: data, status and headers (from WP_HTTP_Response), links by relation, the matched route and handler, and which data processing features apply.
$response = new WP_REST_Response( array( 'id' => 5 ), 201 );
$response->add_link( 'self', rest_url( 'guide/v1/things/5' ) );
$response->add_link( 'author', rest_url( 'wp/v2/users/1' ), array( 'embeddable' => true ) );
$response->set_data_processing( array( 'links' => false ) );
return array( $response->get_status(), array_keys( $response->get_links() ), $response->get_links()['author'][0]['attributes'], $response->get_data_processing(), $response->is_error() );
