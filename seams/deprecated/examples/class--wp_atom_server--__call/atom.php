<?php
// The Atom Publishing Protocol server, removed in 3.5.0 and moved to a plugin: any call reports that it is deprecated and does nothing.
function guide_report_deprecated( $function_name, $replacement, $version ) {
	print( "deprecated_function_run $function_name $version $replacement\n" );
}
add_action( 'deprecated_function_run', 'guide_report_deprecated', 10, 3 );
$server = new wp_atom_server();
return array( $server->handle_request(), wp_atom_server::anything() );
