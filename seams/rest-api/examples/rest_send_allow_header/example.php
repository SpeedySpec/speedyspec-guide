<?php
// Hooked to rest_post_dispatch: sets the Allow header to the methods the user's permission checks allow on the matched route.
$response = new WP_REST_Response();
$response->set_matched_route( '/wp/v2/posts' );
$admin = rest_send_allow_header( $response, rest_get_server(), new WP_REST_Request( 'GET', '/wp/v2/posts' ) )->get_headers()['Allow'];
wp_set_current_user( 0 );
$response = new WP_REST_Response();
$response->set_matched_route( '/wp/v2/posts' );
return array( $admin, rest_send_allow_header( $response, rest_get_server(), new WP_REST_Request( 'GET', '/wp/v2/posts' ) )->get_headers()['Allow'] );
