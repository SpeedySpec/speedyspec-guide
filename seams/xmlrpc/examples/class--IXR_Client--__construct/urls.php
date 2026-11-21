<?php
// A server URL is split into host, port and path (with its query), or given as host, path and port.
$a = new IXR_Client( 'https://example.org:8080/xmlrpc.php?x=1' );
$b = new IXR_Client( 'example.org', '/rpc', 81, 5 );
return array( array( $a->server, $a->port, $a->path, $a->timeout ), array( $b->server, $b->port, $b->path, $b->timeout ), $a->useragent );
