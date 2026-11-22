<?php
// Whether an array is a list: every key is a number.
return array( wp_is_numeric_array( array( 'a', 'b' ) ), wp_is_numeric_array( array( 'x' => 1 ) ), wp_is_numeric_array( 'no' ) );
