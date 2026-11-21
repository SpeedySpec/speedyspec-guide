<?php
// Run the callbacks with the given arguments.
$hook = new WP_Hook();
$hook->add_filter( 'guide', function ( $message ) {
	echo $message;
}, 10, 1 );
$hook->do_action( array( 'hi' ) );

return null;
