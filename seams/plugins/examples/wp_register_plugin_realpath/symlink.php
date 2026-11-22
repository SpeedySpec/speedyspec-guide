<?php
// Records a symlinked plugin folder's real path in wp_plugin_paths, so plugin_basename() can map files back; files directly in the plugins folder are refused.
symlink( WP_PLUGIN_DIR . '/payments', WP_PLUGIN_DIR . '/payments-link' );
$linked = wp_register_plugin_realpath( WP_PLUGIN_DIR . '/payments-link/payments.php' );
$plain = wp_register_plugin_realpath( WP_PLUGIN_DIR . '/shop/shop.php' );
$top = wp_register_plugin_realpath( WP_PLUGIN_DIR . '/hello.php' );
$paths = array();
foreach ( $GLOBALS['wp_plugin_paths'] as $dir => $real ) { $paths[ basename( $dir ) ] = basename( $real ); }
return array( $linked, $plain, $top, $paths, plugin_basename( realpath( WP_PLUGIN_DIR . '/payments-link/payments.php' ) ) );
