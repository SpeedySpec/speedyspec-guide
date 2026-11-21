<?php
// The names of the hooks running now, outermost first.
add_filter( 'guide_c', fn( $v ) => $GLOBALS['wp_current_filter'] );

return apply_filters( 'guide_c', 'v' );
