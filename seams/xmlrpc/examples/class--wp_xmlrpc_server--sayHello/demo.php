<?php
// The demo methods: demo.sayHello, and demo.addTwoNumbers, which needs exactly two integers.
$server = new wp_xmlrpc_server();
return array( $server->sayHello(), $server->addTwoNumbers( array( 2, 3 ) ), $server->addTwoNumbers( array( 2, '3' ) )->code, $server->addTwoNumbers( array( 1 ) )->message );
