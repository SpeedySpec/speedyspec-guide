<?php
// The entries of an array whose keys are in a list, in the array's order.
return wp_array_slice_assoc( array( 'a' => 1, 'b' => 2, 'c' => 3 ), array( 'c', 'a', 'z' ) );
