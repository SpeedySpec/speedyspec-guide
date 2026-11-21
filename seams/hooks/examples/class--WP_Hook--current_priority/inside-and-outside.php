<?php
// The priority running now, or false outside a run.
add_filter( 'guide_p', fn( $v ) => $GLOBALS['wp_filter']['guide_p']->current_priority(), 7 );
$outside = $GLOBALS['wp_filter']['guide_p']->current_priority();

return array( $outside, apply_filters( 'guide_p', 'v' ) );
