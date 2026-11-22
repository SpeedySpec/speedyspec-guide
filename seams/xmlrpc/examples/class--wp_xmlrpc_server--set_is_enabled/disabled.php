<?php
// XML-RPC is on unless xmlrpc_enabled (or the old enable_xmlrpc option filters) turns it off; then every login is refused with 405.
add_filter( 'xmlrpc_enabled', '__return_false' );
$server = new wp_xmlrpc_server();
$server->login( 'admin', 'secret' );
return array( $server->error->code, $server->error->message );
