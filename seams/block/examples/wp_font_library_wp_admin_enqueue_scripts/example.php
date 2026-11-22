<?php
// Hooked to admin_enqueue_scripts: enqueues the Font Library page's scripts and styles inside wp-admin.
wp_font_library_wp_admin_enqueue_scripts( 'index.php' );
$elsewhere = did_action( 'font-library-wp-admin_init' );
$_GET['page'] = 'font-library-wp-admin';
wp_font_library_wp_admin_enqueue_scripts( 'toplevel_page_font-library-wp-admin' );
return array( $elsewhere, did_action( 'font-library-wp-admin_init' ) );
