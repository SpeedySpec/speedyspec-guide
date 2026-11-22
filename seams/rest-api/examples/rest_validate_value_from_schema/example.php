<?php
// Validates a value against a schema (type, enum, format, ranges, lengths, items, properties, anyOf and oneOf); true or the error.
$schema = array( 'type' => 'object', 'properties' => array( 'email' => array( 'type' => 'string', 'format' => 'email' ), 'age' => array( 'type' => 'integer', 'minimum' => 0 ) ) );
return array( rest_validate_value_from_schema( array( 'email' => 'a@example.org', 'age' => 3 ), $schema, 'person' ), rest_validate_value_from_schema( array( 'age' => -1 ), $schema, 'person' )->get_error_message() );
