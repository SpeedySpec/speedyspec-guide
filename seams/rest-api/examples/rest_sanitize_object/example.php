<?php
// A value as an associative array: objects converted, an empty string an empty array; anything else an empty array.
return array( rest_sanitize_object( (object) array( 'a' => 1 ) ), rest_sanitize_object( '' ), rest_sanitize_object( 'x' ) );
