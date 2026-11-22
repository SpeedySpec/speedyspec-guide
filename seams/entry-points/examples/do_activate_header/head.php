<?php
// Fires activate_wp_head; wp-activate.php hooks it to wp_head.
guide_load_functions( 'wp-activate.php', 'do_activate_header', 'wpmu_activate_stylesheet' );
function guide_print_activate_wp_head() {
	echo "activate_wp_head\n";
}
add_action( 'activate_wp_head', 'guide_print_activate_wp_head' );
do_activate_header();
return null;
