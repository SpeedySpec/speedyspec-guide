<?php
// mt.supportedMethods lists the method names; mt.supportedTextFilters is empty unless xmlrpc_text_filters adds some; both fire xmlrpc_call.
add_action( 'xmlrpc_call', fn( $name ) => print( "xmlrpc_call $name\n" ) );
add_filter( 'xmlrpc_text_filters', fn() => array( 'markdown' ) );
$server = new wp_xmlrpc_server();
return array( count( $server->mt_supportedMethods() ), $server->mt_supportedTextFilters() );
