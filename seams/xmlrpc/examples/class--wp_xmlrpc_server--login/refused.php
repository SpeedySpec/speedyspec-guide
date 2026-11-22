<?php
// Authenticates with wp_authenticate(); a failure is a 403 fault, xmlrpc_login_error can change it, and after one failure every later login in the request fails too. Non-scalar credentials are a 400.
function guide_login_error( $error, $user ) {
	return new IXR_Error( 403, 'No: ' . $user->get_error_code() );
}
add_filter( 'xmlrpc_login_error', 'guide_login_error', 10, 2 );
$server = new wp_xmlrpc_server();
$first = $server->login( 'admin', 'secret' );
$message = $server->error->message;
$server->login( 'admin', 'right' );
$again = $server->error->message;
$fresh = new wp_xmlrpc_server();
$fresh->login( array(), 'x' );
return array( $first, $message, $again, $fresh->error->code, $server->login_pass_ok( 'a', 'b' ) );
