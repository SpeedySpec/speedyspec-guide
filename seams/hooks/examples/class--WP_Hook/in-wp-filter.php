<?php
// add_filter() keeps a WP_Hook for each hook name in $wp_filter.
add_filter( 'guide_where', 'trim' );

return get_class( $GLOBALS['wp_filter']['guide_where'] );
