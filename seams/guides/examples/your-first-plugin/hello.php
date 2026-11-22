<?php
// A plugin's first hook: a callback added to admin_notices runs when WordPress fires that action, printing a notice.
add_action( 'admin_notices', function () {
	echo '<div class="notice notice-info"><p>Hello from my first plugin!</p></div>';
} );
ob_start();
do_action( 'admin_notices' );
return ob_get_clean();
