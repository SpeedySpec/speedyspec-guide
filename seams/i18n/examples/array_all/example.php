<?php
// Whether the callback (value, key) is true for every element; true for an empty array.
return array( array_all( array( 2, 4 ), fn( $v ) => 0 === $v % 2 ), array_all( array( 2, 3 ), fn( $v ) => 0 === $v % 2 ), array_all( array(), fn() => false ) );
