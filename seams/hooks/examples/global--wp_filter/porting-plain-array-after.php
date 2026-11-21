<?php
// After: put a WP_Hook there, or use add_filter().
$GLOBALS['wp_filter']['guide_p'] = new WP_Hook();
$GLOBALS['wp_filter']['guide_p']->add_filter( 'guide_p', 'strtoupper', 10, 1 );

return apply_filters( 'guide_p', 'a' );
