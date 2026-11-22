<?php
// The array holds the arguments.
function guide_print_sum( $a, $b ) {
	echo $a + $b;
}
add_action( 'guide_sum', 'guide_print_sum', 10, 2 );
do_action_ref_array( 'guide_sum', array( 2, 3 ) );

return null;
