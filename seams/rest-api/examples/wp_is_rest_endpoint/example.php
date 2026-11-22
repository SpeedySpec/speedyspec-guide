<?php
// Whether the current request is a REST request, REST_REQUEST or the server dispatching; filtered by wp_is_rest_endpoint.
$before = wp_is_rest_endpoint();
function guide_register_me_route() {
	register_rest_route( 'guide/v1', '/me', array( 'methods' => 'GET', 'permission_callback' => '__return_true', 'callback' => 'wp_is_rest_endpoint' ) );
}
add_action( 'rest_api_init', 'guide_register_me_route' );
return array( $before, guide_rest( 'GET', '/guide/v1/me' )[1] );
