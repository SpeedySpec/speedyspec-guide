<?php
// Inside a callback, it names the running hook.
function guide_name_current_filter( $value ) {
	return current_filter();
}
add_filter( 'guide_which', 'guide_name_current_filter' );

return apply_filters( 'guide_which', 'v' );
