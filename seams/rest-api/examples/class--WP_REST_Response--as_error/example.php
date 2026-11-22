<?php
// A response with a status of 400 or more as a WP_Error, from its code, message and data.
$response = rest_convert_error_to_response( new WP_Error( 'too_big', 'Too big.', array( 'status' => 413 ) ) );
$error = $response->as_error();
return array( $response->is_error(), $error->get_error_code(), $error->get_error_message(), $error->get_error_data() );
