<?php
// The one oneOf branch a value validates against; an error when none or several match.
$args = array( 'oneOf' => array( array( 'type' => 'integer' ), array( 'type' => 'number' ) ) );
return array( rest_find_one_matching_schema( 1.5, $args, 'n' ), rest_find_one_matching_schema( 2, $args, 'n' )->get_error_code() );
