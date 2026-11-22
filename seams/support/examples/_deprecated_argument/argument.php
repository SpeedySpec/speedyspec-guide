<?php
// Reports a deprecated argument: fires deprecated_argument_run, then raises a notice when debugging allows it.
add_action( 'deprecated_argument_run', fn( $function, $message, $version ) => print( "$function: $message ($version)\n" ), 10, 3 );
_deprecated_argument( 'some_function', '5.5.0', 'The second argument is unused.' );
return 'reported';
