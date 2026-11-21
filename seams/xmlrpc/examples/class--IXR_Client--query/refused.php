<?php
// Sends a methodCall over a socket; when it can't connect, the error is a transport fault. isError(), getErrorCode() and getErrorMessage() report it.
$client = new IXR_Client( '127.0.0.1', '/xmlrpc.php', 1, 2 );
$ok = $client->query( 'demo.add', 2, 3 );
return array( $ok, $client->isError(), $client->getErrorCode(), $client->getErrorMessage() );
