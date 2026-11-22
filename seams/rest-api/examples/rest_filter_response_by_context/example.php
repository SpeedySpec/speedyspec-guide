<?php
// Keeps only the response's properties whose schema lists the context, recursively.
$schema = array( 'type' => 'object', 'properties' => array( 'id' => array( 'type' => 'integer', 'context' => array( 'view', 'edit' ) ), 'secret' => array( 'type' => 'string', 'context' => array( 'edit' ) ) ) );
return array( rest_filter_response_by_context( array( 'id' => 1, 'secret' => 's' ), $schema, 'view' ), rest_filter_response_by_context( array( 'id' => 1, 'secret' => 's' ), $schema, 'edit' ) );
