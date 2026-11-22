<?php
// Fires activate_wp_head; wp-activate.php hooks it to wp_head.
guide_load_functions( 'wp-activate.php', 'do_activate_header', 'wpmu_activate_stylesheet' );
add_action( 'activate_wp_head', fn() => print( "activate_wp_head\n" ) );
do_activate_header();
return null;
