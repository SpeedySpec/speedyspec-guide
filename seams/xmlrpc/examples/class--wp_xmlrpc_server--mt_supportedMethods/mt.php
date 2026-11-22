<?php
// mt.supportedMethods lists the method names; mt.supportedTextFilters is empty unless xmlrpc_text_filters adds some; both fire xmlrpc_call.
function guide_report_xmlrpc_call( $name ) {
	print( "xmlrpc_call $name\n" );
}
function guide_text_filters( $filters ) {
	return array( 'markdown' );
}
add_action( 'xmlrpc_call', 'guide_report_xmlrpc_call' );
add_filter( 'xmlrpc_text_filters', 'guide_text_filters' );
$server = new wp_xmlrpc_server();
return array( count( $server->mt_supportedMethods() ), $server->mt_supportedTextFilters() );
