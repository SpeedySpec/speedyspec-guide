<?php
// Tracks which code-like elements are open while texturizing, so their contents are left alone.
$stack = array();
_wptexturize_pushpop_element( '<pre>', $stack, array( 'pre' ) );
$open = $stack;
_wptexturize_pushpop_element( '</pre>', $stack, array( 'pre' ) );
return array( $open, $stack );
