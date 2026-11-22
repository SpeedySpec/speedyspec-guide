<?php
// Queues calls to send together as one system.multicall query.
$client = new IXR_ClientMulticall( 'http://example.org/xmlrpc.php' );
$client->addCall( 'demo.add', 1, 2 );
$client->addCall( 'demo.echo', 'x' );
return array( $client->calls, $client->useragent );
