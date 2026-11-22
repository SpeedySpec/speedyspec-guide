<?php
// add_action() calls add_filter(), so a callback added as an action runs when the same name is applied as a filter.
function guide_add_mark( $value ) {
	return $value . '!';
}
add_action( 'guide_value', 'guide_add_mark' );
return apply_filters( 'guide_value', 'a' );
