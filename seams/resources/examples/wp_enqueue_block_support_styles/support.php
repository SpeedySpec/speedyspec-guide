<?php
// Prints block support CSS in the head (or footer, once the head is printed) at a priority; deprecated in 6.1.0 for the style engine's stored styles.
add_action( 'deprecated_function_run', fn( $f, $r, $v ) => print( "$f is deprecated since $v\n" ), 10, 3 );
wp_enqueue_block_support_styles( '.x{color:red}' );
return has_action( 'wp_head' ) !== false;
