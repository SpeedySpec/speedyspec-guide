<?php
// The array holds the value and the extra arguments.
add_filter( 'guide_times', fn( $v, $n ) => $v * $n, 10, 2 );

return apply_filters_ref_array( 'guide_times', array( 3, 4 ) );
