<?php
// Run the 'all' hook's callbacks, as apply_filters() and do_action() do first.
function guide_print_hook_name( $hook_name ) {
	echo $hook_name;
}
add_filter( 'all', 'guide_print_hook_name' );
_wp_call_all_hook( array( 'guide_named' ) );

return null;
