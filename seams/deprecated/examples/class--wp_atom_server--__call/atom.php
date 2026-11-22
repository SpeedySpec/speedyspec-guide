<?php
// The Atom Publishing Protocol server, removed in 3.5.0 and moved to a plugin: any call reports that it is deprecated and does nothing.
add_action( 'deprecated_function_run', fn( $f, $r, $v ) => print( "deprecated_function_run $f $v $r\n" ), 10, 3 );
$server = new wp_atom_server();
return array( $server->handle_request(), wp_atom_server::anything() );
