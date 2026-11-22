<?php
// Maps the wp.*, blogger.*, metaWeblog.*, mt.*, pingback.* and demo.* method names to its methods; xmlrpc_methods can add, replace or remove them.
function guide_xmlrpc_methods( $methods ) {
	unset( $methods['demo.addTwoNumbers'] );
	$methods['guide.ping'] = 'guide_ping';
	return $methods;
}
add_filter( 'xmlrpc_methods', 'guide_xmlrpc_methods' );
$server = new wp_xmlrpc_server();
$prefixes = array_count_values( array_map( fn( $m ) => strtok( $m, '.' ), array_keys( $server->methods ) ) );
return array( $prefixes, $server->methods['wp.getCategories'], $server->methods['wp.uploadFile'], isset( $server->methods['demo.addTwoNumbers'] ), $server->methods['guide.ping'] );
