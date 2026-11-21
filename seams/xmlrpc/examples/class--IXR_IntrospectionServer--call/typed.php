<?php
// Calls are checked against the method's signature: the number and types of params.
class Guide_Server extends IXR_IntrospectionServer { public function __construct() { parent::__construct(); $this->addCallback( 'demo.double', 'this:double', array( 'int', 'int' ), 'Doubles a number' ); $this->message = new IXR_Message( '' ); } public function double( $n ) { return $n * 2; } }
$server = new Guide_Server();
return array( $server->call( 'demo.double', array( 4 ) ), $server->call( 'demo.double', array( 'four' ) )->message, $server->call( 'demo.double', array( 1, 2 ) )->message, $server->methodHelp( 'demo.double' ), $server->methodSignature( 'demo.double' ), $server->methodSignature( 'nope' )->code );
