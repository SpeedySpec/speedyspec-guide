<?php
// Pass extra arguments after the value.
function guide_join( $value, $a, $b ) {
	return "$value $a $b";
}
add_filter( 'guide_join', 'guide_join', 10, 3 );

return apply_filters( 'guide_join', 'v', '1', '2' );
