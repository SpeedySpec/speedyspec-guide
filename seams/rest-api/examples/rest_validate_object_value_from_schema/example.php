<?php
// Validates a value against the object type: required properties, each property's schema, additionalProperties and the property counts.
$args = array( 'type' => 'object', 'properties' => array( 'a' => array( 'type' => 'integer', 'required' => true ) ), 'additionalProperties' => false );
return array( rest_validate_object_value_from_schema( array( 'a' => 1 ), $args, 'o' ), rest_validate_object_value_from_schema( array( 'b' => 1 ), $args, 'o' )->get_error_message(), rest_validate_object_value_from_schema( array( 'a' => 1, 'b' => 2 ), $args, 'o' )->get_error_message() );
