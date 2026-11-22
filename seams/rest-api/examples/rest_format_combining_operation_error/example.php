<?php
// One anyOf or oneOf branch's error as an error for the parameter, naming the branch's title when it has one.
$error = rest_format_combining_operation_error( 'size', array( 'index' => 0, 'schema' => array( 'title' => 'Number' ), 'error_object' => new WP_Error( 'rest_invalid_type', 'size is not of type number.' ) ) );
return array( $error->get_error_code(), $error->get_error_message() );
