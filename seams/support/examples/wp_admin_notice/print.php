<?php
// Prints an admin notice, firing wp_admin_notice first.
function guide_print_admin_notice( $message ) {
	echo "notice: $message\n";
}
add_action( 'wp_admin_notice', 'guide_print_admin_notice' );
return guide_render( fn() => wp_admin_notice( 'Careful.', array( 'type' => 'warning' ) ) );
