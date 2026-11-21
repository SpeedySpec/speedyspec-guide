<?php
// Deprecated in 7.0.0 for wp_slash(): it still slashes, and reports the deprecation through deprecated_function_run.
add_action( 'deprecated_function_run', function ( $name, $replacement, $version ) { echo "$name $version $replacement"; }, 10, 3 );
return addslashes_gpc( "it's" );
