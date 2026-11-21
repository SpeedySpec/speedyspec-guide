<?php
// The first key whose callback (value, key) is true, or null.
return array( array_find_key( array( 'a' => 1, 'b' => 2 ), fn( $v ) => $v > 1 ), array_find_key( array( 1 ), fn() => false ) );
