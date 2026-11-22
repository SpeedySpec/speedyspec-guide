<?php
// Gives a network object back unchanged; deprecated in 3.9.0, when networks gained their site_name.
add_action( 'deprecated_function_run', fn( $f ) => print( "$f is deprecated\n" ) );
return get_current_site_name( (object) array( 'id' => 1, 'site_name' => 'Guide Network' ) )->site_name;
