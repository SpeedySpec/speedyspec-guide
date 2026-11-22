<?php
// When the request itself fails (no connection, a timeout), wp_remote_get() returns a WP_Error, not a response.
function my_plugin_fetch_book( $isbn ) {
	$response = wp_remote_get(
		'https://books.example/v1/books/' . rawurlencode( $isbn ),
		array( 'timeout' => 5 )
	);
	if ( is_wp_error( $response ) ) {
		return $response;
	}
	$code = wp_remote_retrieve_response_code( $response );
	if ( 200 !== $code ) {
		/* translators: %d: The HTTP status code. */
		return new WP_Error( 'my_plugin_http_status', sprintf( __( 'The books service answered %d.', 'my-plugin' ), $code ) );
	}
	return wp_remote_retrieve_body( $response );
}

// A stand-in for the remote books service, so the example never leaves the machine.
function guide_fake_books_service( $pre, $args, $url ) {
	if ( 0 !== strpos( $url, 'https://books.example/' ) ) {
		return $pre;
	}
	$GLOBALS['guide_requests'][] = array( 'url' => $url, 'timeout' => $args['timeout'] );
	if ( false !== strpos( $url, '/slow' ) ) {
		return new WP_Error( 'http_request_failed', 'cURL error 28: Operation timed out after 5000 milliseconds' );
	}
	$found = false !== strpos( $url, '9780441013593' );
	$body  = false !== strpos( $url, '/broken' ) ? '<html>Maintenance</html>' : wp_json_encode( array( 'title' => 'Dune', 'year' => 1965 ) );
	return array(
		'headers'  => array( 'content-type' => 'application/json' ),
		'body'     => $found || false !== strpos( $url, '/broken' ) ? $body : '{"error":"not found"}',
		'response' => $found || false !== strpos( $url, '/broken' ) ? array( 'code' => 200, 'message' => 'OK' ) : array( 'code' => 404, 'message' => 'Not Found' ),
		'cookies'  => array(),
		'filename' => null,
	);
}
add_filter( 'pre_http_request', 'guide_fake_books_service', 10, 3 );

$result = my_plugin_fetch_book( 'slow' ); // The stand-in times out for this one.
return is_wp_error( $result ) ? array( 'code' => $result->get_error_code(), 'message' => $result->get_error_message() ) : $result;
