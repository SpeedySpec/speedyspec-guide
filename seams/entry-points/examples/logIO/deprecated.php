<?php
// Deprecated in 3.4.0 for error_log(): logs XML-RPC input and output when the xmlrpc_logging global is set.
guide_load_functions( 'xmlrpc.php', 'logIO' );
add_action( 'deprecated_function_run', fn( $function, $replacement, $version ) => print( "deprecated_function_run $function $replacement $version\n" ), 10, 3 );
add_filter( 'deprecated_function_trigger_error', '__return_false' );
logIO( 'I', 'request' );
return null;
