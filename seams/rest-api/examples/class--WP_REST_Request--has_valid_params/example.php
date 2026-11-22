<?php
// Validates the parameters against the matched route's arguments: required ones present and each value passing its validate_callback; then sanitize_params() casts them.
$request = new WP_REST_Request( 'GET', '/x' );
$request->set_attributes( array( 'args' => array( 'n' => array( 'type' => 'integer', 'required' => true, 'validate_callback' => 'rest_validate_request_arg', 'sanitize_callback' => 'rest_sanitize_request_arg' ) ) ) );
$missing = $request->has_valid_params();
$request->set_param( 'n', '5' );
$ok = $request->has_valid_params();
$request->sanitize_params();
return array( $missing->get_error_code(), $ok, $request['n'] );
