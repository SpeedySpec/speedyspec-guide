<?php
// Run the callbacks with the given arguments.
function guide_print_message( $message ) {
	echo $message;
}
$hook = new WP_Hook();
$hook->add_filter( 'guide', 'guide_print_message', 10, 1 );
$hook->do_action( array( 'hi' ) );

return null;
