<?php
// The work of wp_prepare_json_schema_for_client() with the allowed keywords given as a lookup.
return wp_json_encode( _wp_prepare_json_schema_for_client_with_allowed_keywords( array( 'type' => 'string', 'format' => 'email', 'x-extra' => 1 ), array( 'type' => true ) ) );
