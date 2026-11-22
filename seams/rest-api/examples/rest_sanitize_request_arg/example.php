<?php
// The sanitize_callback the server gives arguments with a schema: casts the value to the argument's schema.
$request = new WP_REST_Request();
$request->set_attributes( array( 'args' => array( 'n' => array( 'type' => 'integer' ), 'on' => array( 'type' => 'boolean' ) ) ) );
return array( rest_sanitize_request_arg( '7', $request, 'n' ), rest_sanitize_request_arg( 'false', $request, 'on' ) );
