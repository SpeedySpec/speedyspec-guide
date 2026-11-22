<?php
// The value as given; it once prepared data for old PHP JSON encoding and is deprecated in 5.3.0.
add_action( 'deprecated_function_run', fn( $f ) => print( "$f is deprecated\n" ) );
return _wp_json_prepare_data( array( 1 ) );
