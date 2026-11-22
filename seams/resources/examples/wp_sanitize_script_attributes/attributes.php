<?php
// A string of HTML attributes for a script tag, booleans as bare names; deprecated in 7.0.0 for wp_get_script_tag() and wp_get_inline_script_tag().
add_action( 'deprecated_function_run', fn( $f, $r, $v ) => print( "$f is deprecated since $v\n" ), 10, 3 );
return wp_sanitize_script_attributes( array( 'async' => true, 'defer' => false, 'src' => 'a.js?x=1&y=2' ) );
