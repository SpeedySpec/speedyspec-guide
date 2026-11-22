<?php
// In nested hooks, it names the innermost.
function guide_apply_inner( $value ) {
	return apply_filters( 'guide_inner', $value );
}
function guide_name_current_filter( $value ) {
	return current_filter();
}
add_filter( 'guide_outer', 'guide_apply_inner' );
add_filter( 'guide_inner', 'guide_name_current_filter' );

return apply_filters( 'guide_outer', 'v' );
