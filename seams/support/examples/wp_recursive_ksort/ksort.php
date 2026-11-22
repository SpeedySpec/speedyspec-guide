<?php
// Sorts an array by key, nested arrays too, in place.
$a = array( 'b' => array( 'z' => 1, 'y' => 2 ), 'a' => 3 );
wp_recursive_ksort( $a );
return $a;
