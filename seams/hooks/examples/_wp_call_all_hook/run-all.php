<?php
// Run the 'all' hook's callbacks, as apply_filters() and do_action() do first.
add_filter( 'all', function ( $hook_name ) {
	echo $hook_name;
} );
_wp_call_all_hook( array( 'guide_named' ) );

return null;
