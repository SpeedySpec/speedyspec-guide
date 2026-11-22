<?php
// Fires wp_print_footer_scripts, which prints the footer scripts; on wp_footer.
add_action( 'wp_print_footer_scripts', fn() => print( "wp_print_footer_scripts\n" ), 1 );
wp_print_footer_scripts();
return 'done';
