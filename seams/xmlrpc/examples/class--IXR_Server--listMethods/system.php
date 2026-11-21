<?php
function guide_add( $args ) { return $args[0] + $args[1]; }
function guide_one( $arg ) { return $arg; }
// The system methods: listMethods (newest first), getCapabilities and multicall; hasMethod() checks one.
$server = new IXR_Server( array( 'demo.add' => 'guide_add', 'demo.one' => 'guide_one', 'demo.missing' => 'no_such_function', 'demo.self' => 'this:nope' ), false, true );
return array( $server->listMethods( null ), array_keys( $server->getCapabilities( null ) ), $server->hasMethod( 'system.multicall' ) );
