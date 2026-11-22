<?php
// After validation, the sanitize callback cleans the value; your callback only ever sees the clean one.
function my_plugin_list_books( WP_REST_Request $request ) {
	$titles = get_option( 'my_plugin_books', array() );
	return rest_ensure_response( array_slice( $titles, 0, $request['per_page'] ) );
}

function my_plugin_create_book( WP_REST_Request $request ) {
	$titles = get_option( 'my_plugin_books', array() );
	if ( in_array( $request['title'], $titles, true ) ) {
		return new WP_Error( 'my_plugin_book_exists', __( 'That book is already listed.', 'my-plugin' ), array( 'status' => 409 ) );
	}
	$titles[] = $request['title'];
	update_option( 'my_plugin_books', $titles );
	return new WP_REST_Response( array( 'title' => $request['title'] ), 201 );
}

function my_plugin_can_create_books() {
	return current_user_can( 'edit_posts' );
}

// A validate_callback replaces the schema's own check, so it runs that check first, then tests the value as saved.
function my_plugin_validate_title( $value, WP_REST_Request $request, $param ) {
	$valid = rest_validate_request_arg( $value, $request, $param );
	if ( true !== $valid ) {
		return $valid;
	}
	$title = sanitize_text_field( $value );
	return '' !== $title && mb_strlen( $title ) <= 200;
}

function my_plugin_register_routes() {
	register_rest_route(
		'my-plugin/v1',
		'/books',
		array(
			array(
				'methods'             => WP_REST_Server::READABLE,
				'callback'            => 'my_plugin_list_books',
				'permission_callback' => '__return_true', // The list is public.
				'args'                => array(
					'per_page' => array( 'type' => 'integer', 'default' => 10, 'minimum' => 1, 'maximum' => 100 ),
				),
			),
			array(
				'methods'             => WP_REST_Server::CREATABLE,
				'callback'            => 'my_plugin_create_book',
				'permission_callback' => 'my_plugin_can_create_books',
				'args'                => array(
					'title' => array(
						'type'              => 'string',
						'required'          => true,
						'validate_callback' => 'my_plugin_validate_title',
						'sanitize_callback' => 'sanitize_text_field',
					),
				),
			),
		)
	);
}
add_action( 'rest_api_init', 'my_plugin_register_routes' );

// Sends a request to the REST API from PHP, and gives back its status and data, as a client would see them.
function guide_send( $method, $route, array $params = array() ) {
	$request = new WP_REST_Request( $method, $route );
	foreach ( $params as $name => $value ) {
		$request->set_param( $name, $value );
	}
	$response = rest_do_request( $request );
	return array( 'status' => $response->get_status(), 'data' => rest_get_server()->response_to_data( $response, false ) );
}

$created = guide_send( 'POST', '/my-plugin/v1/books', array( 'title' => " Dune <script>alert(1)</script>\n" ) );
return array( 'response' => $created, 'stored' => get_option( 'my_plugin_books' ) );
