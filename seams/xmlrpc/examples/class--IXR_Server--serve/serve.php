<?php
function guide_add( $args ) { return $args[0] + $args[1]; }
function guide_one( $arg ) { return $arg; }
// Parses the request, calls the method and prints the methodResponse (or a fault), with the XML declaration in the site's charset, then exits.
$server = new IXR_Server( array( 'demo.add' => 'guide_add' ), false, true );
$server->serve( '<methodCall><methodName>demo.add</methodName><params><param><value><int>2</int></value></param><param><value><int>3</int></value></param></params></methodCall>' );
return 'not reached';
