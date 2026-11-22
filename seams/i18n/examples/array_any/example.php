<?php
// Whether the callback (value, key) is true for any element; false for an empty array.
return array( array_any( array( 1, 2 ), fn( $v ) => $v > 1 ), array_any( array( 'a' => 1 ), fn( $v, $k ) => 'b' === $k ), array_any( array(), fn() => true ) );
