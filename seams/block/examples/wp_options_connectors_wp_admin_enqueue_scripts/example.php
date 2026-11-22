<?php
// Hooked to admin_enqueue_scripts: enqueues the Connectors settings page's scripts and styles inside wp-admin.
wp_options_connectors_wp_admin_enqueue_scripts( 'index.php' );
$elsewhere = did_action( 'options-connectors-wp-admin_init' );
$_GET['page'] = 'options-connectors-wp-admin';
wp_options_connectors_wp_admin_enqueue_scripts( 'toplevel_page_options-connectors-wp-admin' );
return array( $elsewhere, did_action( 'options-connectors-wp-admin_init' ) );
