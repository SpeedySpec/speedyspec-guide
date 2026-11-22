<?php
// A pingback fault, which xmlrpc_pingback_error can change.
function guide_pingback_error( $error ) {
	return new IXR_Error( 0, 'hidden' );
}
add_filter( 'xmlrpc_pingback_error', 'guide_pingback_error' );
$server = new wp_xmlrpc_server();
$error = Closure::bind( fn() => $this->pingback_error( 17, 'The source URL does not contain a link to the target URL.' ), $server, wp_xmlrpc_server::class )();
return array( $error->code, $error->message );
