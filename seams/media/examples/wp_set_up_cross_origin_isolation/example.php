<?php
// Hooked to load-* admin screens: sends Document-Isolation-Policy on the media, block editor, site editor and widgets screens when client-side processing is on.
$_SERVER['HTTP_HOST'] = 'localhost';
$_SERVER['HTTP_USER_AGENT'] = 'Mozilla/5.0 AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36';
require_once ABSPATH . 'wp-admin/includes/class-wp-screen.php';
require_once ABSPATH . 'wp-admin/includes/screen.php';
set_current_screen( 'dashboard' );
$dashboard = wp_set_up_cross_origin_isolation();
set_current_screen( 'media' );
return array( $dashboard, wp_set_up_cross_origin_isolation() );
