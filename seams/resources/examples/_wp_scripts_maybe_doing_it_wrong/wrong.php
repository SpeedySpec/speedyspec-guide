<?php
// Reports a doing-it-wrong notice, naming the handle, when a script or style function is called before init, wp_enqueue_scripts, admin_enqueue_scripts or login_enqueue_scripts has run; afterwards, as here, nothing.
function guide_print_doing_it_wrong( $function_name ) {
	echo "$function_name was called too early\n";
}
add_action( 'doing_it_wrong_run', 'guide_print_doing_it_wrong' );
_wp_scripts_maybe_doing_it_wrong( 'wp_enqueue_script', 'mine' );
return did_action( 'init' );
