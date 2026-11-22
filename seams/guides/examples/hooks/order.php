<?php
// Lower priorities run first; at one priority, callbacks run in the order they were added.
function guide_add_a( $value ) {
	return $value . 'a';
}
function guide_add_b( $value ) {
	return $value . 'b';
}
function guide_add_c( $value ) {
	return $value . 'c';
}
add_filter( 'guide_order', 'guide_add_a' );
add_filter( 'guide_order', 'guide_add_b' );
add_filter( 'guide_order', 'guide_add_c', 5 );
return apply_filters( 'guide_order', '' );
