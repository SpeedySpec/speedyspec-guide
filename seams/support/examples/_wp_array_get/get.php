<?php
// A value from a nested array by a path of keys, or a default when the path is missing.
$a = array( 'a' => array( 'b' => array( 'c' => 1 ) ) );
return array( _wp_array_get( $a, array( 'a', 'b', 'c' ) ), _wp_array_get( $a, array( 'a', 'x' ), 'none' ) );
