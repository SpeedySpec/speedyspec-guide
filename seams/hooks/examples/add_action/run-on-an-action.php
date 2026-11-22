<?php
// Run code when an action fires.
function guide_say_ready() {
	echo 'ready';
}
add_action( 'guide_ready', 'guide_say_ready' );
do_action( 'guide_ready' );

return did_action( 'guide_ready' );
