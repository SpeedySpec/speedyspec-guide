<?php
// Run code when an action fires.
add_action( 'guide_ready', function () {
	echo 'ready';
} );
do_action( 'guide_ready' );

return did_action( 'guide_ready' );
