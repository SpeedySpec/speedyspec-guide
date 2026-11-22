<?php
// Casts a value to its schema: types, formats (email, URL, date, color, IP, UUID, text field), items and properties, dropping unknown properties when additionalProperties is false.
$schema = array( 'type' => 'object', 'properties' => array( 'n' => array( 'type' => 'integer' ), 'tags' => array( 'type' => 'array', 'items' => array( 'type' => 'string' ) ), 'site' => array( 'type' => 'string', 'format' => 'uri' ) ), 'additionalProperties' => false );
return rest_sanitize_value_from_schema( array( 'n' => '4', 'tags' => 'a,b', 'site' => 'example.org/x y', 'extra' => 1 ), $schema );
