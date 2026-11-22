<?php
// Registers a route in a namespace with its methods, callback, permission check and arguments, on rest_api_init; the server matches requests to it and validates the arguments before the callback runs.
add_action( 'rest_api_init', function () {
	register_rest_route( 'guide/v1', '/greet/(?P<name>[a-z]+)', array(
		'methods'             => 'GET',
		'callback'            => fn( $request ) => array( 'hello' => $request['name'], 'loud' => $request['loud'] ),
		'permission_callback' => '__return_true',
		'args'                => array( 'loud' => array( 'type' => 'boolean', 'default' => false ) ),
	) );
} );
return array( guide_rest( 'GET', '/guide/v1/greet/ada', array( 'loud' => 'true' ) ), guide_rest( 'GET', '/guide/v1/greet/ADA' )[0] );
