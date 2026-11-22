<?php
// A WP_Error as a response: its codes, messages and data, with the status from the first data's status (default 500).
$error = new WP_Error( 'too_big', 'Too big.', array( 'status' => 413 ) );
$response = rest_convert_error_to_response( $error );
return array( $response->get_status(), $response->get_data() );
