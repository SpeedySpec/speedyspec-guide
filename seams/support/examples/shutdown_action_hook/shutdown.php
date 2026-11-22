<?php
// Fires shutdown, then closes the object cache; registered to run when PHP shuts down.
function guide_print_shutdown() {
	echo "shutdown\n";
}
add_action( 'shutdown', 'guide_print_shutdown' );
shutdown_action_hook();
return 'done';
