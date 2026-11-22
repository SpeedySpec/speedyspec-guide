<?php
// Private methods used to be callable from outside: _multisite_getUsersBlogs() still is, anything else gives false.
$server = new wp_xmlrpc_server();
return $server->__call( 'nope', array() );
