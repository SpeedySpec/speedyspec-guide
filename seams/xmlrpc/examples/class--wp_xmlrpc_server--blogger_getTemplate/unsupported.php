<?php
// blogger.getTemplate and blogger.setTemplate are no longer supported: a 403 fault.
$server = new wp_xmlrpc_server();
return array( $server->blogger_getTemplate( array() )->message, $server->blogger_setTemplate( array() )->code );
