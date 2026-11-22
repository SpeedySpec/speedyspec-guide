<?php
// Prints the second step of network setup: the wp-config.php constants and .htaccess or web.config rules to add, with keys and salts when missing.
require_once ABSPATH . 'wp-admin/includes/network.php';
$html = guide_render( 'network_step2' );
return array( str_contains( $html, "define( 'MULTISITE', true );" ), str_contains( $html, 'RewriteEngine On' ) );
