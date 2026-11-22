<?php
// Fires wp_enqueue_scripts, where themes and plugins queue their front-end scripts and styles; on wp_head.
add_action( 'wp_enqueue_scripts', fn() => print( "wp_enqueue_scripts\n" ), 0 );
wp_enqueue_scripts();
return 'done';
