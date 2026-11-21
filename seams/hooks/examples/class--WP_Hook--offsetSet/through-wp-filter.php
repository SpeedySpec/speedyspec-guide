<?php
// Setting a priority on a hook in $wp_filter, as core does.
add_filter( 'guide_o', 'trim' );
$GLOBALS['wp_filter']['guide_o'][20] = array( 'k' => array( 'function' => 'strtoupper', 'accepted_args' => 1 ) );

return apply_filters( 'guide_o', ' a ' );
