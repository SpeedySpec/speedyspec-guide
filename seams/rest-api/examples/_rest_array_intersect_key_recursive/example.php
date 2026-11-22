<?php
// Keeps only the keys present in a second array, recursively; rest_filter_response_fields() uses it for nested _fields.
return _rest_array_intersect_key_recursive( array( 'a' => 1, 'b' => array( 'c' => 2, 'd' => 3 ), 'e' => 4 ), array( 'a' => true, 'b' => array( 'c' => true ) ) );
