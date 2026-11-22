<?php
// The array holds the value and the extra arguments.
function guide_times( $value, $by ) {
	return $value * $by;
}
add_filter( 'guide_times', 'guide_times', 10, 2 );

return apply_filters_ref_array( 'guide_times', array( 3, 4 ) );
