<?php
// For a logged-in user it records their sites and home; it hooks the header styles and wp_head bump, enqueues the admin bar's script and style, and fires admin_bar_init.
guide_log_in( array( 'read' => true ) );
add_action( 'admin_bar_init', fn() => print( "admin_bar_init\n" ) );
$bar = new WP_Admin_Bar();
$bar->initialize();
return array( $bar->user->domain, has_action( 'wp_head', '_admin_bar_bump_cb' ) );
