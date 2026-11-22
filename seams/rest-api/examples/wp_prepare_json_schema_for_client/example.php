<?php
// A schema readied for clients: keywords outside the profile dropped, WordPress's required flags turned into required lists, and empty-object defaults kept as objects, recursively.
$schema = array( 'type' => 'object', 'context' => array( 'view' ), 'properties' => array( 'name' => array( 'type' => 'string', 'required' => true, 'arg_options' => array() ), 'opts' => array( 'type' => 'object', 'default' => array() ) ) );
return wp_json_encode( wp_prepare_json_schema_for_client( $schema ) );
