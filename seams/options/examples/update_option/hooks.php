<?php
// The actions update_option() fires, in order.
function guide_echo_hook_name() {
	echo current_filter() . ' ';
}
foreach ( array( 'update_option', 'update_option_blogname', 'updated_option' ) as $hook ) {
	add_action( $hook, 'guide_echo_hook_name' );
}
update_option( 'blogname', 'Renamed' );
