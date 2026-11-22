<?php
// Fires wp_enqueue_scripts, where themes and plugins queue their front-end scripts and styles; on wp_head.
function guide_print_wp_enqueue_scripts() {
	echo "wp_enqueue_scripts\n";
}
add_action( 'wp_enqueue_scripts', 'guide_print_wp_enqueue_scripts', 0 );
wp_enqueue_scripts();
return 'done';
