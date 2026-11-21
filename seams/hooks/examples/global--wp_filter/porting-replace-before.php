<?php
// Before: clearing every hook by replacing $wp_filter.
add_filter( 'guide_x', 'strtoupper' );
global $wp_filter;
$wp_filter = array();

return has_filter( 'guide_x' );
