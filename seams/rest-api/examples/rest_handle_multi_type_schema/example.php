<?php
// The type to use for a value against a schema with several types; '' when none fits, warning about invalid types.
return array( rest_handle_multi_type_schema( 'false', array( 'type' => array( 'boolean', 'string' ) ) ), rest_handle_multi_type_schema( array(), array( 'type' => array( 'integer', 'string' ) ) ) );
