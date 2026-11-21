<?php
// After: iterate it with foreach, or test one hook with isset().
add_filter( 'guide_k', 'trim' );
$names = array();
foreach ( $GLOBALS['wp_filter'] as $name => $hook ) {
	$names[] = $name;
}

return array( in_array( 'guide_k', $names, true ), isset( $GLOBALS['wp_filter']['guide_k'] ) );
