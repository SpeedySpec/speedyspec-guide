<?php
// remove_all_filters() with a priority removes only the callbacks at that priority, on a hook the plugin owns.
function guide_early( $value ) {
	return $value . 'early ';
}
function guide_late( $value ) {
	return $value . 'late';
}
add_filter( 'guide_list', 'guide_early', 5 );
add_filter( 'guide_list', 'guide_late' );
remove_all_filters( 'guide_list', 5 );
return apply_filters( 'guide_list', '' );
