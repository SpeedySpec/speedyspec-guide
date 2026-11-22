<?php
// Whether an email is valid, optionally checking its domain resolves; deprecated in 3.0.0 for is_email().
add_action( 'deprecated_function_run', fn( $f, $r, $v ) => print( "$f is deprecated since $v" . ( $r ? " for $r" : '' ) . "\n" ), 10, 3 );
return array( validate_email( 'ada@example.org', false ), validate_email( 'nope', false ) );
