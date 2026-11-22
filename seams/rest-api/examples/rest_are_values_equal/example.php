<?php
// Whether two values are equal the way JSON Schema compares them: arrays recursively, numbers by value.
return array( rest_are_values_equal( array( 'a' => 1, 'b' => 2 ), array( 'b' => 2, 'a' => 1 ) ), rest_are_values_equal( 1, 1.0 ), rest_are_values_equal( '1', 1 ) );
