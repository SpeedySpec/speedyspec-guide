<?php
// Without a name, it says whether any hook is running; with one, whether that hook is.
function guide_apply_inner( $value ) {
	return apply_filters( 'guide_inner', $value );
}
function guide_report_doing( $value ) {
	return var_export( array( doing_filter(), doing_filter( 'guide_outer' ), doing_filter( 'guide_other' ) ), true );
}
add_filter( 'guide_outer', 'guide_apply_inner' );
add_filter( 'guide_inner', 'guide_report_doing' );

return apply_filters( 'guide_outer', 'v' );
