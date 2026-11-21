<?php
function guide_add( $args ) { return $args[0] + $args[1]; }
function guide_one( $arg ) { return $arg; }
// Calls a method's callback with the params, a single param given alone; unknown methods and missing callbacks give faults.
$server = new IXR_Server( array( 'demo.add' => 'guide_add', 'demo.one' => 'guide_one', 'demo.missing' => 'no_such_function', 'demo.self' => 'this:nope' ), false, true );
$results = array( $server->call( 'demo.add', array( 2, 3 ) ), $server->call( 'demo.one', array( 'only' ) ) );
foreach ( array( 'nope', 'demo.missing', 'demo.self' ) as $method ) {
	$results[] = $server->call( $method, array() )->message;
}
return $results;
