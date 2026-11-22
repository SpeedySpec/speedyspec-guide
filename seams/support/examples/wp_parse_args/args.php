<?php
// Arguments merged over defaults: an array, an object's properties, or a query string.
return array( wp_parse_args( 'a=1&b=two', array( 'a' => 0, 'c' => 3 ) ), wp_parse_args( (object) array( 'x' => 1 ), array( 'y' => 2 ) ) );
