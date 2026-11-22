<?php
// The validate_callback the server gives arguments with a schema: checks the value against the argument's schema.
$request = new WP_REST_Request();
$request->set_attributes( array( 'args' => array( 'n' => array( 'type' => 'integer', 'minimum' => 1 ) ) ) );
$bad = rest_validate_request_arg( 0, $request, 'n' );
return array( rest_validate_request_arg( 3, $request, 'n' ), $bad->get_error_message() );
