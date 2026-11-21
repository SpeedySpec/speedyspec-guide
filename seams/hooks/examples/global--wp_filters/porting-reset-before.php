<?php
// Before: resetting the counts by replacing $wp_filters.
apply_filters( 'guide_f', 'v' );
$GLOBALS['wp_filters'] = array();

return did_filter( 'guide_f' );
