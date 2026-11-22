<?php
// Validates a value against the integer type: a number without a fraction, then the number checks.
$args = array( 'type' => 'integer', 'multipleOf' => 5 );
return array( rest_validate_integer_value_from_schema( 10, $args, 'n' ), rest_validate_integer_value_from_schema( 2.5, $args, 'n' )->get_error_message(), rest_validate_integer_value_from_schema( 7, $args, 'n' )->get_error_message() );
