<?php
function guide_add( $args ) { return $args[0] + $args[1]; }
function guide_one( $arg ) { return $arg; }
// Runs several calls, each result in a one-element array or a fault struct; recursive multicalls and malformed entries are faults.
$server = new IXR_Server( array( 'demo.add' => 'guide_add', 'demo.one' => 'guide_one', 'demo.missing' => 'no_such_function', 'demo.self' => 'this:nope' ), false, true );
return $server->multiCall( array( array( 'methodName' => 'demo.add', 'params' => array( 1, 2 ) ), array( 'methodName' => 'system.multicall', 'params' => array() ), array( 'methodName' => 'demo.add', 'params' => 'x' ), 'bad' ) );
