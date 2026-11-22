<?php
// The actions delete_option() fires, in order.
function guide_echo_hook_name() {
	echo current_filter() . ' ';
}
foreach ( array( 'delete_option', 'delete_option_blogdescription', 'deleted_option' ) as $hook ) {
	add_action( $hook, 'guide_echo_hook_name' );
}
delete_option( 'blogdescription' );
