<?php
// A URL query string from an array, without encoding the values.
return build_query( array( 'a' => 1, 'b' => 'x y', 'c' => array( 1, 2 ) ) );
