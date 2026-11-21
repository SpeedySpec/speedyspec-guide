<?php
// Before: reading $wp_filter with array functions.
add_filter( 'guide_k', 'trim' );

return in_array( 'guide_k', array_keys( $GLOBALS['wp_filter'] ), true );
