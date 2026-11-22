<?php
// Route arguments from a schema's properties for a method: read-only properties left out, required and defaults only for creating, each validated and sanitized by its schema.
$schema = array( 'properties' => array( 'id' => array( 'type' => 'integer', 'readonly' => true ), 'title' => array( 'type' => 'string', 'required' => true ), 'status' => array( 'type' => 'string', 'default' => 'draft' ) ) );
$create = rest_get_endpoint_args_for_schema( $schema );
$edit = rest_get_endpoint_args_for_schema( $schema, WP_REST_Server::EDITABLE );
return array( array_keys( $create ), $create['title']['required'], $create['status']['default'], isset( $edit['status']['default'] ), $edit['title']['required'] ?? false );
