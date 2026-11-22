<?php
// Validates then sanitizes an argument against its schema; the validation error when it fails.
$request = new WP_REST_Request();
$request->set_attributes( array( 'args' => array( 'tags' => array( 'type' => 'array', 'items' => array( 'type' => 'integer' ) ) ) ) );
return array( rest_parse_request_arg( '1,2,3', $request, 'tags' ), rest_parse_request_arg( 'a,b', $request, 'tags' )->get_error_code() );
