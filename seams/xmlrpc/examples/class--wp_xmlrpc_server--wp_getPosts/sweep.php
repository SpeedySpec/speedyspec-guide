<?php
// Every method that acts for a user logs in first: without valid credentials each answers 403, and those that check their arguments first answer 400 to too few, or, like wp.getProfile, to a fields argument that isn't an array.
$server = new wp_xmlrpc_server();
$results = array();
foreach ( $server->methods as $name => $method ) {
	if ( ! str_starts_with( $method, 'this:' ) || in_array( $name, array( 'pingback.ping', 'pingback.extensions.getPingbacks', 'mt.getTrackbackPings', 'mt.supportedMethods', 'mt.supportedTextFilters', 'demo.sayHello', 'demo.addTwoNumbers' ), true ) ) {
		continue;
	}
	$fresh = new wp_xmlrpc_server();
	$result = $fresh->{ substr( $method, 5 ) }( array( 1, 'admin', 'secret', 1, array(), array() ) );
	$results[ $result instanceof IXR_Error ? $result->code : get_debug_type( $result ) ][] = $name;
}
$short = ( new wp_xmlrpc_server() )->wp_getPost( array( 1, 'admin' ) );
return array( array_map( fn( $names ) => count( $names ) > 3 ? count( $names ) : $names, $results ), $short->code, $short->message );
