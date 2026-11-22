<?php
// The current network, the $current_site global; deprecated in 3.9.0.
add_action( 'deprecated_function_run', fn( $f ) => print( "$f is deprecated\n" ) );
return wpmu_current_site()->site_name;
