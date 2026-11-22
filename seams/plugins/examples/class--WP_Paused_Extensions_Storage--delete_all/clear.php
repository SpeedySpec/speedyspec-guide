<?php
// delete_all() removes one type's entries; the option is deleted once nothing is paused.
define( 'WP_RECOVERY_MODE_SESSION_ID', 'guide' );
wp_recovery_mode()->initialize();
$plugins = new WP_Paused_Extensions_Storage( 'plugin' );
$themes = new WP_Paused_Extensions_Storage( 'theme' );
$plugins->set( 'shop', array( 'message' => 'x' ) );
$themes->set( 'shiny', array( 'message' => 'y' ) );
$plugins->delete_all();
$left = get_option( 'guide_paused_extensions' );
$themes->delete( 'shiny' );
return array( $left, get_option( 'guide_paused_extensions' ) );
