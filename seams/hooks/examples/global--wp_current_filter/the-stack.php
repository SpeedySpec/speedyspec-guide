<?php
// The names of the hooks running now, outermost first.
function guide_running_hooks( $value ) {
	return $GLOBALS['wp_current_filter'];
}
add_filter( 'guide_c', 'guide_running_hooks' );

return apply_filters( 'guide_c', 'v' );
