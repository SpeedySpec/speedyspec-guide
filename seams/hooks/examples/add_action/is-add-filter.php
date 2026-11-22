<?php
// An action callback is a filter callback: add_action() calls add_filter().
function guide_add_mark( $value ) {
	return $value . '!';
}
add_action( 'guide_value', 'guide_add_mark' );

return apply_filters( 'guide_value', 'a' );
