<?php
// The error for a value that matched no anyOf or oneOf branch: the one branch's error when only one could fit its type, else a general error.
$errors = array(
	array( 'index' => 0, 'schema' => array( 'type' => 'integer' ), 'error_object' => new WP_Error( 'rest_invalid_type', 'size is not of type integer.' ) ),
	array( 'index' => 1, 'schema' => array( 'type' => 'boolean' ), 'error_object' => new WP_Error( 'rest_invalid_type', 'size is not of type boolean.' ) ),
);
return rest_get_combining_operation_error( 'big', 'size', $errors )->get_error_message();
