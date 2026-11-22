<?php
// Fires wp_print_footer_scripts, which prints the footer scripts; on wp_footer.
function guide_print_wp_print_footer_scripts() {
	echo "wp_print_footer_scripts\n";
}
add_action( 'wp_print_footer_scripts', 'guide_print_wp_print_footer_scripts', 1 );
wp_print_footer_scripts();
return 'done';
