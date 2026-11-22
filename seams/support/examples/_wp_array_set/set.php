<?php
// Sets a value in a nested array by a path of keys, making the missing levels.
$a = array();
_wp_array_set( $a, array( 'a', 'b' ), 1 );
return $a;
