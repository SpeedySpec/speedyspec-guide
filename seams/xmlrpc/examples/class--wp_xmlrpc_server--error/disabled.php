<?php
// Prints a fault and ends the request; when XML-RPC is off, the fault's code is also the HTTP status.
add_filter( 'xmlrpc_enabled', '__return_false' );
$server = new wp_xmlrpc_server();
$server->error( 405, 'XML-RPC services are disabled on this site.' );
return 'not reached';
