<?php
// Validates a value against the string type: minLength, maxLength and pattern.
$args = array( 'type' => 'string', 'minLength' => 2, 'pattern' => '^[a-z]+$' );
return array( rest_validate_string_value_from_schema( 'ok', $args, 's' ), rest_validate_string_value_from_schema( 'a', $args, 's' )->get_error_message(), rest_validate_string_value_from_schema( 'A1', $args, 's' )->get_error_message() );
