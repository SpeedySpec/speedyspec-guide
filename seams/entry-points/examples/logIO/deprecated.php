<?php
// Deprecated in 3.4.0 for error_log(): logs XML-RPC input and output when the xmlrpc_logging global is set.
guide_load_functions( 'xmlrpc.php', 'logIO' );
function guide_print_deprecated_function( $function, $replacement, $version ) {
	echo "deprecated_function_run $function $replacement $version\n";
}
add_action( 'deprecated_function_run', 'guide_print_deprecated_function', 10, 3 );
add_filter( 'deprecated_function_trigger_error', '__return_false' );
logIO( 'I', 'request' );
return null;
