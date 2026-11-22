<?php
// Validates a value against the array type: each item's schema, minItems, maxItems and uniqueItems.
$args = array( 'type' => 'array', 'items' => array( 'type' => 'integer' ), 'maxItems' => 2, 'uniqueItems' => true );
return array( rest_validate_array_value_from_schema( array( 1, 2 ), $args, 'l' ), rest_validate_array_value_from_schema( array( 1, 2, 3 ), $args, 'l' )->get_error_message(), rest_validate_array_value_from_schema( array( 1, 1 ), $args, 'l' )->get_error_message() );
