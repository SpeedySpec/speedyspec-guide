<?php
// Inside an action callback, it names the action.
add_action( 'guide_now', function () {
	echo current_action();
} );
do_action( 'guide_now' );

return null;
