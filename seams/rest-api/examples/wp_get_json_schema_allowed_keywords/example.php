<?php
// The JSON Schema keywords a profile allows clients to see: rest-api, the REST keywords, or draft-04, those plus $schema, $ref, required, allOf and the rest; filtered by wp_json_schema_allowed_keywords.
$rest = wp_get_json_schema_allowed_keywords();
$draft = wp_get_json_schema_allowed_keywords( 'draft-04' );
return array( count( $rest ), array_values( array_diff( $draft, $rest ) ) );
