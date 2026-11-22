<?php
// The priority running now, or false outside a run.
function guide_current_priority( $value ) {
	return $GLOBALS['wp_filter']['guide_p']->current_priority();
}
add_filter( 'guide_p', 'guide_current_priority', 7 );
$outside = $GLOBALS['wp_filter']['guide_p']->current_priority();

return array( $outside, apply_filters( 'guide_p', 'v' ) );
