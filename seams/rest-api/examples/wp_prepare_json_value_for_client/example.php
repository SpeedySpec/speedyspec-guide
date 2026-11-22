<?php
// A value readied for JSON by its schema: empty arrays where the schema wants objects become objects, through properties, items and anyOf or oneOf.
$schema = array( 'type' => 'object', 'properties' => array( 'meta' => array( 'type' => 'object' ), 'list' => array( 'type' => 'array' ) ) );
return wp_json_encode( wp_prepare_json_value_for_client( array( 'meta' => array(), 'list' => array() ), $schema ) );
