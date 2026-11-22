<?php
// The first anyOf branch a value validates against, or the error for none.
$args = array( 'anyOf' => array( array( 'type' => 'integer' ), array( 'type' => 'string', 'enum' => array( 'auto' ) ) ) );
return array( rest_find_any_matching_schema( 'auto', $args, 'width' ), rest_find_any_matching_schema( 'wide', $args, 'width' )->get_error_code() );
