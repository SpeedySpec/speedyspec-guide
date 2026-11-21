<?php
// It refuses a DOCTYPE, an unexpected root, malformed XML, and more elements than xmlrpc_element_limit allows.
$results = array();
foreach ( array( '<!DOCTYPE x><methodCall/>', '<other/>', '<methodCall><params>', '' ) as $xml ) {
	$results[] = ( new IXR_Message( $xml ) )->parse();
}
add_filter( 'xmlrpc_element_limit', fn() => 2 );
$results[] = ( new IXR_Message( '<methodCall><methodName>a</methodName><params><param><value>x</value></param></params></methodCall>' ) )->parse();
return $results;
