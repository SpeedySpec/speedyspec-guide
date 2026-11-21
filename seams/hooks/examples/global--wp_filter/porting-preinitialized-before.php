<?php
// Before: replacing $wp_filter with build_preinitialized_hooks().
$GLOBALS['wp_filter'] = WP_Hook::build_preinitialized_hooks( array( 'guide_b' => array( 10 => array( array( 'function' => 'strtoupper', 'accepted_args' => 1 ) ) ) ) );

return apply_filters( 'guide_b', 'a' );
