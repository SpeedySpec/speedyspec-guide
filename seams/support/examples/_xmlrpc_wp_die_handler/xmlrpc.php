<?php
// Ends an XML-RPC request for wp_die(): the XML-RPC server sends an IXR fault with the status and message. Here a stand-in server prints what it would send.
require_once ABSPATH . WPINC . '/class-IXR.php';
$GLOBALS['wp_xmlrpc_server'] = new class { public function output( $xml ) { echo $xml; } };
return guide_render( fn() => _xmlrpc_wp_die_handler( 'Failed.', '', array( 'exit' => false, 'response' => 500 ) ) );
