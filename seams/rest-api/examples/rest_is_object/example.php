<?php
// Whether a value reads as an object: an array, an object, an empty string or a JsonSerializable.
return array( rest_is_object( array( 'a' => 1 ) ), rest_is_object( new stdClass() ), rest_is_object( '' ), rest_is_object( 'x' ) );
