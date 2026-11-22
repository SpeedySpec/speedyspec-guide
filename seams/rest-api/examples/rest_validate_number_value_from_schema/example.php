<?php
// Validates a value against the number type: minimum and maximum (exclusive or not) and multipleOf.
$args = array( 'type' => 'number', 'minimum' => 0, 'maximum' => 1, 'exclusiveMaximum' => true );
return array( rest_validate_number_value_from_schema( 0.5, $args, 'r' ), rest_validate_number_value_from_schema( 1, $args, 'r' )->get_error_message(), rest_validate_number_value_from_schema( 'x', $args, 'r' )->get_error_code() );
