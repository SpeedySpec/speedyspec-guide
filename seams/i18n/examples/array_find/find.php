<?php
// PHP 8.4's array searches, polyfilled before: the first value or key whose callback (value, key) is true, or null; whether any or all match.
$a = array( 'x' => 1, 'y' => 4, 'z' => 9 );
$big = fn( $v, $k ) => $v > 3;
return array( array_find( $a, $big ), array_find_key( $a, $big ), array_any( $a, $big ), array_all( $a, $big ), array_find( array(), $big ) );
