<?php
// Reports a deprecated function: fires deprecated_function_run, then raises a notice when WP_DEBUG is on and deprecated_function_trigger_error allows it.
add_action( 'deprecated_function_run', fn( $f, $r, $v ) => print( "$f is deprecated since $v\n" ), 10, 3 );
_deprecated_function( 'old_thing', '6.0.0', 'new_thing' );
return 'reported';
