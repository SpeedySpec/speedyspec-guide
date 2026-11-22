<?php
// For a URL someone typed, use wp_safe_remote_get(): it refuses addresses inside your own network.
// A stand-in records what each request asked for, and answers without leaving the machine.
function guide_record_request( $pre, $args, $url ) {
	$GLOBALS['guide_rejects_unsafe'][] = $args['reject_unsafe_urls'];
	return array( 'headers' => array(), 'body' => '', 'response' => array( 'code' => 200, 'message' => 'OK' ), 'cookies' => array(), 'filename' => null );
}
add_filter( 'pre_http_request', 'guide_record_request', 10, 3 );

wp_remote_get( 'https://books.example/feed' );
wp_safe_remote_get( 'https://books.example/feed' );

// Before sending a safe request, WordPress checks its address with wp_http_validate_url().
return array(
	'wp_remote_get checks'      => $GLOBALS['guide_rejects_unsafe'][0],
	'wp_safe_remote_get checks' => $GLOBALS['guide_rejects_unsafe'][1],
	'a public address'          => (bool) wp_http_validate_url( 'https://93.184.215.14/feed' ),
	'this machine'              => wp_http_validate_url( 'http://127.0.0.1/wp-admin/' ),
	'the private network'       => wp_http_validate_url( 'http://192.168.1.1/' ),
	'cloud metadata'            => wp_http_validate_url( 'http://169.254.169.254/latest/meta-data/' ),
	'not http'                  => wp_http_validate_url( 'file:///etc/passwd' ),
);
