<?php
// A callback must be a function name, an object and method, or 'this:method': a closure fails on function_exists() with a TypeError.
$server = new IXR_Server( array( 'demo.add' => fn( $args ) => 1 ), false, true );
return $server->call( 'demo.add', array( 1 ) );
