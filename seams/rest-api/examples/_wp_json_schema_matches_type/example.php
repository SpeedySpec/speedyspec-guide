<?php
// Whether a value matches a schema through a type, looking into anyOf and oneOf branches that allow it.
$schema = array( 'anyOf' => array( array( 'type' => 'array' ), array( 'type' => 'object' ) ) );
return array( _wp_json_schema_matches_type( array(), $schema, 'object' ), _wp_json_schema_matches_type( array(), array( 'type' => 'string' ), 'object' ) );
