<?php
// Decode what came back as untrusted data: it may not be JSON, or may lack the fields you expect.
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

function my_plugin_book_title( $url ) {
	$response = wp_remote_get( $url, array( 'timeout' => 5 ) );
	if ( is_wp_error( $response ) || 200 !== wp_remote_retrieve_response_code( $response ) ) {
		return null;
	}
	$data = json_decode( wp_remote_retrieve_body( $response ), true );
	if ( ! is_array( $data ) || ! isset( $data['title'] ) || ! is_string( $data['title'] ) ) {
		return null;
	}
	return sanitize_text_field( $data['title'] );
}

return array(
	'good answer'     => my_plugin_book_title( 'https://books.example/v1/books/9780441013593' ),
	'not JSON at all' => my_plugin_book_title( 'https://books.example/v1/broken' ),
);
