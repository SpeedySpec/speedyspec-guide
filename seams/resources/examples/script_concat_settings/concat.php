<?php
// Sets the concatenation and compression globals to false when unset; deprecated in 7.2.0, when script concatenation was removed.
add_action( 'deprecated_function_run', fn( $f, $r, $v ) => print( "$f is deprecated since $v\n" ), 10, 3 );
script_concat_settings();
return array( $GLOBALS['concatenate_scripts'], $GLOBALS['compress_scripts'], $GLOBALS['compress_css'] );
