<?php
// Paused plugins or themes are stored per recovery-mode session, in the {session}_paused_extensions option, by type and extension; without an active session nothing is stored.
$plugins = new WP_Paused_Extensions_Storage( 'plugin' );
$outside = $plugins->set( 'shop', array( 'message' => 'x' ) );
define( 'WP_RECOVERY_MODE_SESSION_ID', 'guide' );
wp_recovery_mode()->initialize();
$plugins->set( 'shop', array( 'type' => E_ERROR, 'message' => 'Fatal' ) );
$plugins->set( 'reports', array( 'message' => 'Other' ) );
( new WP_Paused_Extensions_Storage( 'theme' ) )->set( 'shiny', array( 'message' => 'Theme' ) );
$all = $plugins->get_all();
$plugins->delete( 'reports' );
return array( $outside, array_keys( $all ), $plugins->get( 'shop' ), $plugins->get( 'reports' ), array_keys( get_option( 'guide_paused_extensions' ) ) );
