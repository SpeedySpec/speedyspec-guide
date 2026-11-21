<?php
// Adds slashes to a string, or to the strings in an array (in place), at any depth; objects are left.
$server = new wp_xmlrpc_server();
$args = array( "it's", array( 'a"b' ), (object) array( 'x' => "'" ) );
$server->escape( $args );
$one = "o'k";
return array( $server->escape( $one ), $args[0], $args[1][0], $args[2]->x );
