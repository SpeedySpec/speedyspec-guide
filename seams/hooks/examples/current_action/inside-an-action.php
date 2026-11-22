<?php
// Inside an action callback, it names the action.
function guide_print_current_action() {
	echo current_action();
}
add_action( 'guide_now', 'guide_print_current_action' );
do_action( 'guide_now' );

return null;
