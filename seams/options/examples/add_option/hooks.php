<?php
// The actions add_option() fires, in order.
function guide_echo_hook_name() {
	echo current_filter() . ' ';
}
foreach ( array( 'add_option', 'add_option_guide_color', 'added_option' ) as $hook ) {
	add_action( $hook, 'guide_echo_hook_name' );
}
add_option( 'guide_color', 'blue' );
