<?php
// Whether a value is one of a schema's enum values; the error lists them when it isn't.
$args = array( 'type' => 'string', 'enum' => array( 'red', 'blue' ) );
return array( rest_validate_enum( 'red', $args, 'color' ), rest_validate_enum( 'green', $args, 'color' )->get_error_message() );
