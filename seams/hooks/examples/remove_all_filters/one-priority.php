<?php
// Remove only the callbacks at one priority.
function guide_add_a( $value ) {
	return $value . 'a';
}
function guide_add_b( $value ) {
	return $value . 'b';
}
add_filter( 'guide_x', 'guide_add_a', 5 );
add_filter( 'guide_x', 'guide_add_b' );
remove_all_filters( 'guide_x', 5 );

return apply_filters( 'guide_x', '' );
