<?php
// The array holds the arguments.
add_action( 'guide_sum', function ( $a, $b ) {
	echo $a + $b;
}, 10, 2 );
do_action_ref_array( 'guide_sum', array( 2, 3 ) );

return null;
